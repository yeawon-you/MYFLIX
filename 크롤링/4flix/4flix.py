import requests
from bs4 import BeautifulSoup
                             
f = open("movie.sql", 'w', -1, "utf-8")

login_url = 'https://www.4flix.co.kr/login_check'

user = 'sosom1029'
password = 'fhekwn0404'

session = requests.session()

params = dict()
params['login_id'] = user
params['login_pw'] = password

res = session.post(login_url, data = params)

res.raise_for_status()

url = 'https://www.4flix.co.kr/board/netflix/p'

for i in range(1, 347):
    link = url + str(i)
    response = requests.get(link)
    source = response.text
    soup = BeautifulSoup(source, 'html.parser')
    for j in soup.find_all(class_='gall_li'): # 영화 하나 선택
        try:
            list2 = j.find('a')
            review = list2.get('href')
            
            response2 = requests.get(review)
            
            source2 = response2.text
            soup2 = BeautifulSoup(source2, 'html.parser') # 리뷰창
            try:
                info = soup2.find(id="bo_v_info_add")
                div = info.findAll("div")
                text = div[1].get_text()
                rate = text[0] + text[1] + text[2]
            except Exception as e:
                rate = 0.0
            k = soup2.find(id="bo_v_link")
            k2 = k.find('a')
            netflix = k2.get('title') # 넷플릭스 링크
            
            netflix_num = netflix.split('/')[4]
            netflix = "https://www.netflix.com/kr/title/" + netflix_num

            response3 = requests.get(netflix)
            source3 = response3.text
            soup3 = BeautifulSoup(source3, 'html.parser')
            
            title = soup3.find(class_="title-title")
            info = soup3.find(class_="title-info-synopsis")
            actor = soup3.find(class_="title-data-info-item-list")
            genre = soup3.find(class_="title-info-metadata-item item-genre")
            img = soup3.find(class_="hero-image hero-image-desktop")
            imgsrc = img.get("style")
            
            f.write("(NULL, '" + title.get_text() + "', '" + info.get_text() + "', '" + actor.get_text() + "', '" + genre.get_text() + "', '" + imgsrc.split("\"")[1] + "', '" + str(rate) + "'),\n")
        except Exception as e:
            print(e)

f.close()
        
