import os
import sys


moduleName = sys.argv[1]


moduleNameLowerCase = str.lower(moduleName)
moduleNameCamelCase = str.upper(moduleName[0:1])+str.lower(moduleName[1:])


os.makedirs(moduleNameCamelCase)
os.makedirs(moduleNameCamelCase+"/config")
os.makedirs(moduleNameCamelCase+"/src")
os.makedirs(moduleNameCamelCase+"/src/"+ moduleNameCamelCase)
os.makedirs(moduleNameCamelCase+"/src/"+ moduleNameCamelCase +"/Controller")
os.makedirs(moduleNameCamelCase+"/src/"+ moduleNameCamelCase + "/Form")
os.makedirs(moduleNameCamelCase+"/src/"+ moduleNameCamelCase + "/Model")
os.makedirs(moduleNameCamelCase+"/view")
os.makedirs(moduleNameCamelCase+"/view/"+moduleNameLowerCase)
os.makedirs(moduleNameCamelCase+"/view"+moduleNameLowerCase+"/"+moduleNameLowerCase)