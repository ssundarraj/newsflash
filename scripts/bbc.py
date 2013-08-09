import bs4, urllib2, json, sys, os, MySQLdb
try:
	html=urllib2.urlopen('http://www.bbc.com/news/').read()
except:
	print json.dumps("Urllib error")

with open("../sources/bbc_temp.txt", "wb") as fo:
	fo.write(json.dumps(html));

soup=bs4.BeautifulSoup(html)
tags=soup.findAll('a', {"class":"story"})
tags.extend(soup.findAll('a', {"class":"headline-anchor"}))
links=[]
for tag in tags:
	link=tag['href']
	if(link[0]!='h'):
		link="http://www.bbc.co.uk"+link
	links.append(link)
titles=[]
contents_list=[]
for link in links:
	try:
		news_html=urllib2.urlopen(link).read()
		news_soup=bs4.BeautifulSoup(news_html)
		title=news_soup.find('h1', {"class":"story-header"})#.contents
		if(type(title)==bs4.element.Tag):
			title=title.contents
			titles.append(title[0])
			title=title[0]
			content=news_soup.find('div', {"class":"story-body"})##must check if is exists
			paras=""
			if(type(content)==bs4.element.Tag):
				for para in content.findAll('p', {"class":""}):
					if(type(para.contents[0])==bs4.element.NavigableString):
						paras=paras+" "+unicode(para.contents[0])
				isFileWritten=False	
				with open("../sources/bbc/"+title+".txt", "wb") as fo:
					#content=content.encode('ascii', 'ignore')## CHANGE THE ENCODING!!!!!!!!!!!!!!! @@@
					fo.write(json.dumps(paras))
					isFilewritten=True
				if(isFilewritten):	
					try:
						conn=MySQLdb.connect("localhost","root","pass","newsreader")
						cur=conn.cursor()
						sql="INSERT INTO bbc (title, link) VALUES (%s, %s)"
						cur.execute(sql, (title, link))
						conn.commit()
					except:
						print json.dumps("ERROR4")
					finally:
						cur.close()
						conn.close()
	except:
		pass