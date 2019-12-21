from __future__ import absolute_import, print_function
import tweepy
from tweepy import OAuthHandler, Stream, StreamListener

import pymysql

from geopy.geocoders import GoogleV3

from datetime import datetime
import json
import jsonpickle
import sys
import time
import pytz
import re
from urllib3.exceptions import ProtocolError, ReadTimeoutError
from requests.exceptions import ConnectionError, Timeout
from OpenSSL import SSL

# Go to http://apps.twitter.com and create an app.
# The consumer key and secret will be generated for you after
consumer_key = ''
consumer_secret = ''
access_token = ''
access_token_secret = ''

#timezone
tz = pytz.timezone('Asia/Jakarta')

#Stopwords
stopwords = ['dishub','pkl','wib','arus','lalu','lintas','terpantau','pantauan','panataun',
                 'seputaran','simpang','sepi','ramai','lancar','peningkatan','volume','arah',
                'masuk','kota','kendaraan','padat','bergerak','keluar','sepi','imbas',
                'di','tutupnya','harap','menghindari','e100','antrian','tiap','kaki',
                'hindari','proyek','projek','box','curvert','culvert','mengarah',
                 'untuk','depan','merambat','sisi','barat','flyover','dibuka','kembali',
                'luar','arah','sudah','kembali','sudah','mobil','kebakaran','seputar'
            'dan','exit','giat','selasa','sampai','maupun','parkir','e','u','turn','','update',
            'waspada','kemacetan','uturn','truk','mogok','terguling','traffic','selamat','video'
            ,'timelapse','traffic','yang','tronton','sebelum','bawah','antisipasi','kepadatan','wayah',
             'wes','totolan','karena','antisispasi','arulin','atrus','aus','ke','lints','wb','wi','alalu','jl','aryus'
            ,'bengi','dulur','tetap','semangat','banyaknya','!','pantaua','siang','malam','pagi',
             'ishub','hari','car','free','day','terpantaua','suasana','info','terkait','tadi',
             'tolong','pukul','light','berteduh','kawasan','senin','selasa','rabu','kamis','jumat'
            ,'sabtu','minggu','penutupan','pengendara','massa','gedung','cfd','pantuan','intas'
             ,'suporter','bola','kawan','bertugas','surabaya','ini','patroli','over','dua'
             ,'pen','pengenzetan','jalan','pantauaan','dan','pembenahan','topi','pantaaun'
             ,'dsishub','sepuatran','jelang','jalur','hujan','gerimis','wis','siap','r','hati'
             ,'vs','unjuk','rasa','dihimbau','kawan','berikut','travel','mengalami','dibawah','linta'
             ,'saat','air','fly','terkini','raya','jam','bat','akses','pintu','akan','melintas'
            ,'ilu','tersendat','cuaca','melintas','llu','bisa','dari','rekan','jaga','jarak'
             ,'bung','hambatan','seputaranm','panjang','llau','rombongan','berkumpul','dalam','tl'
             ,'moge','sepuataran','eib','pantroli','bereteduh','berkendara','kepadata','beberapa',
             'kondisi','kantor','hingga','depanterminal','tertib','suroboyo','deras','sekitar','ujung',
            'naik','diseparator','dprd','tk','lampu','yg','lau','kecelakaan','licin','pasca'
            ,'dushub','dalan','mulai','patah','as','mancur','diseputaran','dkrth','perantingan'
            ,'karenakan','pengaspalan','kecelakaan','masih','melintasi','terbalik','dihindari',
            'sekitar','eputaran','upa','mau','ruas','sore','arek','hormati','hak','terpatau','ada'
            ,'menikmati','pengunjung','dengan','harapan','terbatas','lancarcauca','mohon',
             'seputar','lepas','miring','keselamatan','tengah','nampak','maneh','dilewati'
             ,'banyak','bubaran','begerak','pergerakan','lanca','handle','pengesetan'
            ,'selepas','pom','menepi','desember','pengensetan','disertai','ramaim','pandangan','cctv'
            ,"terlihat"]
#Category
listLancar = ['ramai','lancar','sepi']
listPadat = ['peningkatan','volume','padat','macet','kemacetan']
kondisi =""

#Function for cleaning text
def clean_text(text):
    text = text.lower()
    text = re.sub(r"[^A-Za-z0-9(),!?\'\`]", " ", text)
    text = re.sub(r"\'s", " \'s", text)
    text = re.sub(r"\'ve", " \'ve", text)
    text = re.sub(r"n\'t", " n\'t", text)
    text = re.sub(r"\'re", " \'re", text)
    text = re.sub(r"\'d", " \'d", text)
    text = re.sub(r"\'ll", " \'ll", text)
    text = re.sub(r",", "", text)
    text = re.sub(r"!", " ! ", text)
    text = re.sub(r"\(", " \( ", text)
    text = re.sub(r"\)", " \) ", text)
    text = re.sub(r"\?", " \? ", text)
    text = re.sub(r"\s{2,}", " ", text)
    text = re.sub("\d+", "", text)
    text = text.replace('\\(','')
    text = text.replace('\\)','')
    text = text.replace('\\?','')
    return text.strip()
#Function for extract road condition
def extract_kondisi(teks):
    global kondisi
    if any(word in teks for word in listPadat):
        kondisi = "Padat"
    elif any(word in teks for word in listLancar):
        kondisi = "Lancar"
    else:
        pass
    return kondisi
#Function to insert data for streaming twitter
def insertIntoMysql(textTweet,dateTweet,category,jalanName,latLoc,lngLoc,media):
    #mysql config 
    dbServer        = "db-tweet.cr00p4kudq0x.ap-southeast-1.rds.amazonaws.com"
    dbUser          = "admin"
    dbPassword      = "simpan03"
    dbName          = "db_tweet"
    try:
        #Connect
        connectionObject   = pymysql.connect(host=dbServer, 
                                            user=dbUser, 
                                            password=dbPassword,
                                            port=3306,
                                            db=dbName)
        cursorObject = connectionObject.cursor()
        sql = """
            INSERT INTO streamTable 
            (textTweet,dateTweet,category,jalanName,latLoc,lngLoc) 
            VALUES 
            (%s,%s,%s,%s,%s,%s)
            """
        recordTuple = (textTweet,dateTweet,category,jalanName,latLoc,lngLoc)
        cursorObject.execute(sql,recordTuple)
        connectionObject.commit()
        print("Date entered to AWS RDS ")
    except Exception as e:
        print(e)
        connectionObject.rollback()
        connectionObject.close()
    finally:
        connectionObject.close()
        print("Stream re-run....")
#Twitter streamer main function
class StdOutListener(StreamListener):
    """ A listener handles tweets that are received from the stream.
    This is a basic listener that just prints received tweets to stdout.
    """
    def on_data(self, data):
        # print(data)
        now = datetime.now(tz)
        all_data = json.loads(data)
        try:
            if "extended_tweet" in all_data:
                textTweet = all_data['extended_tweet']['full_text']
            else:
                textTweet = all_data['text']
            try:
                media = all_data['entities']['media'][0]['media_url']
            except:
                media = ""
            print(textTweet)
            print(media)

            #Get exact information
            kondisi = extract_kondisi(textTweet)
            text = clean_text(textTweet)
            removeStop = [word for word in text.split() if word not in stopwords]
            resultTeks = ' '.join(removeStop[:2])
            tgl = now.strftime("%Y-%m-%d %H:%M")

            print(kondisi)
            print(resultTeks)
            print(tgl)
            #Get location latitude and longitude
            geolocator = GoogleV3(api_key='AIzaSyCk8_2Z96uO5jHZ0s_GR7gtctXVdFC8iWs', domain='maps.googleapis.com')
            try:
                location = geolocator.geocode("jalan" + resultTeks + "surabaya")
                latLoc = str(location.latitude)
                lngLoc = str(location.longitude)
                jalanName = str(resultTeks)
            except:
                latLoc = "-7.250445"
                lngLoc = "112.768845"
                jalanName ="Surabaya"
            print(latLoc,lngLoc)
            if kondisi is not "":
                insertIntoMysql(textTweet,tgl,kondisi,jalanName,latLoc,lngLoc,media) 
            else:
                pass 
                print("Stream re-run, nothing passed to AWS RDS ...")
        except Exception as e:
            print(e)
        return True , data

    def on_error(self, status):
        print(status)
#Main activity
if __name__ == '__main__':
    l = StdOutListener()
    auth = OAuthHandler(consumer_key, consumer_secret)
    auth.set_access_token(access_token, access_token_secret)

    # stream = Stream(auth, l)
    # stream.filter(follow=['565999500'])

    # Twitter dummy = 1163665498334044161
    # Dishub Surabaya Twitter = 203740486

    while True:
        try:
            print("Stream on:")
            stream = Stream(auth, l,tweet_mode='extended')
            stream.filter(follow=['203740486'])
        except SSL.WantReadError as e:
            print("SSL WantReadError, sleeping...")
            time.sleep(5)
        except tweepy.RateLimitError:
            time.sleep(15 * 60)
        except (ProtocolError, ConnectionError, ReadTimeoutError, Timeout) as e:
            print("Network error happened, sleeping...")
            print(str(e))
            time.sleep(5)
        except KeyboardInterrupt:
            print("System exit, progress terminated need start over ....")        
            sys.exit(1)
