#!/usr/bin/python
import getpass
import MySQLdb
from optparse import OptionParser


dbhost = "localhost"
root = "root"
ApDBname = "ReceptionDB"
ApDBuser = "ultimate"
ApDBpasswd = "software"


def createDB(cursor,force):
    if(force): 
        cursor.execute("DROP DATABASE %s" % ApDBname )
    cursor.execute("CREATE DATABASE %s" % ApDBname )
    cursor.execute("USE %s" % ApDBname )
    cursor.execute("CREATE TABLE EMPLOYEES (ID INTEGER PRIMARY KEY, FIRST VARCHAR(20), LAST VARCHAR(20), EMAIL VARCHAR(50), EXT INTEGER)")
    cursor.execute("CREATE TABLE VEHICLES (TAG CHAR(6) PRIMARY KEY, MODEL CHAR(20), EMPLOYEE INTEGER)")
    cursor.execute("CREATE TABLE LOGGINS ( TIME INTEGER PRIMARY KEY, USERNAME VARCHAR(20), SUCCESS BOOLEAN)")
    cursor.execute("CREATE TABLE USERS (ID INTEGER PRIMARY KEY, USERNAME CHAR(20), PASSWORD CHAR(20))")
    cursor.execute("CREATE TABLE HISTORY (TIME INTEGER PRIMARY KEY, TAG CHAR(20), EMAIL VARCHAR(50), MESSAGE CHAR(70))")

def createDBuser(cursor,force):
    if(force): 
        cursor.execute("DROP USER '%s'@'%s'" % (ApDBuser, dbhost))
    cursor.execute("CREATE USER '%s'@'%s' IDENTIFIED BY '%s'" % (ApDBuser, dbhost, ApDBpasswd))
    cursor.execute("GRANT ALL PRIVILEGES ON %s.* TO '%s'@'%s'" %  (ApDBname, ApDBuser, dbhost))
    cursor.execute("FLUSH PRIVILEGES")
    cursor.execute("USE %s" % ApDBname )
    sqltext = "INSERT INTO USERS VALUES (%d, '%s', '%s')" % (0,ApDBuser,ApDBpasswd)
    cursor.execute(sqltext)
    cursor.execute("COMMIT")
    

def loadUsers(cursor,inputfile):
    datafile = open(inputfile, 'r')
    for line in datafile:
           data = line.split( )
           sqltext = "INSERT INTO USERS VALUES (%d, '%s', '%s')" % (int(data[0]),data[1],data[2])
           print sqltext
           cursor.execute(sqltext)
    cursor.execute("COMMIT")

def listApUsers(cursor):
    cursor.execute("SELECT * FROM USERS")
    print "Number of users = %d " % cursor.rowcount
    for i in xrange(cursor.rowcount):
        data = cursor.fetchone()
        print "%d %s" % (data[0], data[1])

def loadEmployees(cursor,inputfile):
    datafile = open(inputfile, 'r')
    for line in datafile:
        data = line.split( )
        sqltext = "INSERT INTO EMPLOYEES VALUES (%d, '%s', '%s', '%s', %d)" % (int(data[0]),data[1],data[2],data[3],int(data[4]))
        print sqltext
        cursor.execute(sqltext)
    cursor.execute("COMMIT")

def listEmployees(cursor):
    cursor.execute("SELECT * FROM EMPLOYEES")
    print "Number of employees = %d " % cursor.rowcount
    for i in xrange(cursor.rowcount):
        data = cursor.fetchone()
        print "%d %s %s %s %d" % (data[0], data[1], data[2], data[3], data[4])

def loadVehicles(cursor,inputfile):
    datafile = open(inputfile, 'r')
    for line in datafile:
        data = line.split( );
        sqltext = "INSERT INTO VEHICLES VALUES ('%s', '%s', %d)" % (data[0],data[1],int(data[2]))
        print sqltext
        cursor.execute(sqltext)
    cursor.execute("COMMIT");

def listVehicles(cursor):
    cursor.execute("SELECT * FROM VEHICLES")
    print "Number of vehicles = %d " % cursor.rowcount
    for i in xrange(cursor.rowcount):
        data = cursor.fetchone()
        print "%s %s %d" % (data[0], data[1], data[2])

def listLoginHistory(cursor):
    cursor.execute("SELECT * FROM LOGGINS")
    print "Number of loggins = %d : " % cursor.rowcount 
    for i in xrange(cursor.rowcount):
        data = cursor.fetchone()
        print "%d %s %d" % (data[0],data[1],data[2])


def main():
    parser = OptionParser("usage: %prog [options] arg")
    parser.add_option("--createDB",dest="createDB", action="store_true", default=False)
    parser.add_option("--createDBuser", dest="createDBuser", action="store_true", default=False)
    parser.add_option("--force",dest="force", action="store_true", default=False)
    parser.add_option("--loadApUsers", dest="apUsersFile", default="")
    parser.add_option("--listApUsers", dest="listApUsers", action="store_true", default=False)
    parser.add_option("--loadEmployees", dest="EmployeesFile", default="")
    parser.add_option("--listEmployees", dest="listEmployees", action="store_true", default=False)
    parser.add_option("--loadVehicles", dest="VehiclesFile", default="")
    parser.add_option("--listVehicles", dest="listVehicles", action="store_true", default=False)
    parser.add_option("--listLoginHistory", dest="listLoginHistory", action="store_true", default=False)
    (options, args) = parser.parse_args()
    
    #adminpasswd = raw_input('Enter SQL admin password or ENTER: ')
    print 'Enter MySQL root password: '
    adminpasswd = getpass.getpass()

    #These functions create the database and admin user
    db=MySQLdb.connect(host=dbhost,user=root,passwd=adminpasswd)
    cursor = db.cursor()
    
    if options.createDB:
         createDB(cursor,options.force)
        
    if options.createDBuser:
        createDBuser(cursor,options.force)
        
    # these functions load data into the database
    dbAp=MySQLdb.connect(host=dbhost,user=root,passwd=adminpasswd,db=ApDBname)
    cursorAp = dbAp.cursor()

    if options.apUsersFile != "":
        loadUsers(cursorAp,options.apUsersFile)
        print "App users loaded."
    
    if options.listApUsers:
        listApUsers(cursorAp)

    if options.EmployeesFile != "":
        loadEmployees(cursorAp,options.EmployeesFile)
        print "Employees loaded."
    
    if options.listEmployees:
        listEmployees(cursorAp)

    if options.VehiclesFile != "":
        loadVehicles(cursorAp,options.VehiclesFile)
        print "Vehicles loaded."
    
    if options.listVehicles:
        listVehicles(cursorAp)

    if options.listLoginHistory:
        listLoginHistory(cursorAp)

    db.close()

if __name__ == "__main__":
    main()

