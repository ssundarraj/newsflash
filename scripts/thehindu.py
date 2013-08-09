import bs4, urllib2, json, sys, os, MySQLdb

try:
	html=urllib2.urlopen('http://www.thehindu.com/news/').read()
	soup=bs4.BeautifulSoup(html)
	tags=soup.findAll('h3')
	links=[]
	for tag in tags:
		if(type(tag.a)==bs4.element.Tag):
			if(tag.a['href']!='http://www.thehindu.com/news/'):
				links.append(tag.a['href'])
except:
	print json.dumps("ERROR1")
	sys.exit(1)

for link in links:
	print link
	try:
		news_html=urllib2.urlopen(link).read()
		news_soup=bs4.BeautifulSoup(news_html)
		title=news_soup.find('h1', {"class":"detail-title"})
		if(type(title)==bs4.element.Tag):
			title=title.contents[0]
		paras=news_soup.findAll('p', {"class":"body"})
		content=""
		for para in paras:
			if(len(para.contents)!=0):
				content=content+" "+unicode(para.contents[0])
	except: 
		print json.dumps("ERROR2")
	#if(type(title)==str and type(link)==str):
	print title
	isFileWritten=False
	if(len(title)!=0 and len(content)!=0):
		with open("../sources/thehindu/"+title+".txt", "wb") as fo:
			#content=content.encode('ascii', ignore)## CHANGE THE ENCODING!!!!!!!!!!!!!!! @@@
			fo.write(json.dumps(content))
			isFilewritten=True
		if(isFilewritten):	
			try:
				conn=MySQLdb.connect("localhost","root","pass","newsreader")
				cur=conn.cursor()
				sql="INSERT INTO thehindu (title, link) VALUES (%s, %s)"
				cur.execute(sql, (title, link))
				conn.commit()
			except:
				print json.dumps("ERROR4")
			finally:
				cur.close()
				conn.close()