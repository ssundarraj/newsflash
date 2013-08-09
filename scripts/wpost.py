import bs4
import urllib2
import json

print "______________@#@#@#@#@#@#@#@#@#@#@#_______________"
html=urllib2.urlopen('http://www.washingtonpost.com/').read()
html=html.decode('utf-8').encode('utf-8')
soup=bs4.BeautifulSoup(html, from_encoding='utf-8')
print soup.prettify()
tags=soup.findAll('h2')#, {"class":"no-left"})
#tags.append(soup.findAll('h2', {"class:":"headline"}))
print tags