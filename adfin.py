#!/usr/bin/python
# Admin Finder via HTTP Fingerprint
# by ./MyHeartIsyr a.k.a Shikata_Ga_Nai
# This code is messy, i hope you want to modify it

import httplib
import sys

banner = """
\t\t\t\t\t===================================================
\t\t\t\t\t== Admin Finder by ./MyHeartIsyr                 ==
\t\t\t\t\t== usage: adfin.py [target] [list of admin page] ==
\t\t\t\t\t== ex: adfin.py www.target.com list.txt          ==
\t\t\t\t\t===================================================
"""
if len(sys.argv) <= 2:
    print banner
    sys.exit(1)

buka = open(sys.argv[2])
baca = buka.readlines()

print banner
for x in baca:
    konek = httplib.HTTPConnection(sys.argv[1], 80)
    konek.request("GET", x)
    r1 = konek.getresponse()
    if(r1.status == "200"):
        print "[+] Found: "+ x
    else:
        print "[-] Not Found: "+ x