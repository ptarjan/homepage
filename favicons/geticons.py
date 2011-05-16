#!/usr/bin/env python
import os
import urllib2
from BeautifulSoup import BeautifulSoup
root = 'http://paultarjan.com/sites.php'

page = urllib2.urlopen(root)
soup = BeautifulSoup(page)
for a in soup('a', rel='me'):
    for img in a('img'):
        src = img['src']
        if 'http://' in src:
            fname = a.text + '.ico'
            fname = fname.replace(' ', '_')

            if os.path.isfile(fname):
                print 'Skipping %s' % fname
                continue
            try:
                data = urllib2.urlopen(src).read()
                f = open(fname, 'w')
                f.write(data)
                f.close()
            except Exception, e:
                print src, fname, e
