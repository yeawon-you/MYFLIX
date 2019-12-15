import requests
from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.support import expected_conditions as EC

f = open("movie.sql", 'w', -1, "utf-8")
f.write("INSERT INTO Ranking VALUES ")

driver = webdriver.Chrome()
driver.implicitly_wait(3)
url = 'http://unogs.com/?q=-!1900,2019-!0,5-!0,10-!0,10-!Any-!Any-!Any-!Any-!I%20Don&cl=21,23,26,29,33,307,45,39,327,331,334,265,337,336,269,267,357,65,67,392,268,400,402,408,412,447,348,270,73,34,425,432,46,78,&st=adv&ob=Relevance&p='
for j in range(1, 142):
    url = url + str(j) + '&ao=and'
    driver.get(url)

    try:
        element = WebDriverWait(driver, 3).until(
                EC.presence_of_element_located((By.ID, "listdiv"))
            )
    except TimeoutException:
        sys.exit(1)

    html = driver.page_source
    soup = BeautifulSoup(html, 'html.parser')

    lists = soup.find(id='listdiv')

    for i in lists.findAll('a'):
        link0 = i.get('href')
        link = 'http://unogs.com' + link0
        driver.get(link)
        try:
            element = WebDriverWait(driver, 3).until(
                    EC.presence_of_element_located((By.CLASS_NAME,'tenstars')) 
                )
        except TimeoutException:
            continue
        html2 = driver.page_source
        soup2 = BeautifulSoup(html2, 'html.parser') # 영화 하나
        h4 = soup2.find(id="vtitle")
       
        poster = soup2.find(id='poster')
        
        span = soup2.find(class_="tenstars")    
        f.write("('"+ h4.get_text() + "', '" + span.get('title') + "', '" + poster.get('src') + "'), ")

driver.close()
f.close()
