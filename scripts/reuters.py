import bs4
import urllib2
import json
import unicodedata

html=urllib2.urlopen('http://www.reuters.com').read()
html=html.decode('utf-8').encode('utf-8')
soup=bs4.BeautifulSoup(html, from_encoding='utf-8')
links_h2=soup.findAll('h2')
links=[]
heads=[]
for tag in links_h2:
	link=tag.a['href']
	if link[0]!=h:
		link='http://www.reuters.com'+link
	links.append(link)
	heads.append(tag.contents)

content=[]
'''
for link in links:
	response=urllib2.urlopen(link)
	html=response.read()
	soup=bs4.BeautifulSoup(html)
	#soup.find() get the contents
	#cont=.....
	contents.append(cont)
'''
print json.dumps(heads)