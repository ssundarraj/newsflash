import bs4
import urllib2
import json

html=urllib2.urlopen('http://www.nytimes.com/').read()
html=html.decode('utf-8').encode('utf-8')
soup=bs4.BeautifulSoup(html, from_encoding='utf-8')
tags=soup.findAll('h3')