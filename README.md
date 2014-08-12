****Info about Reception Helper Applicaiton ****

*****Application Functionality:
-Secure Login:
*users must be registered in the database
*login times out after 10 minutes
*user account is locked after 5 login attempts in 1 minute or 15 in 1 day.

-Admin account 'ultimate', registered by default, can:
*register new users
*register new company employees (owners of vehicles)

-Users can:
*register new vehicles, 
*search for vehicle owners, 
*send automatic email messages within the company domain
*list incident history


********Installation:
1) MySQL, PHP, python should be installed on host

2) MySQL initialization:
-Create the database and tables:
python dbConfig.py --createDB
-Create user of the database needed by application:
python dbConfig.py --createDBuser

If running these again one needs to add the --force option.

3) (optional) 
-Load application users:
python dbConfig.py --loadApUsers UsersData.txt
-Load employees:
python dbConfig.py --loadEmployees EmployeeData.txt 
-Load vehicles:
python dbConfig.py --loadVehicles VehicleData.txt


3) Move ReceptionHelper folder to public web space.


*******Package command line tools:
-list Ap users:
python dbConfig.py --listApUsers
-list employees:
python dbConfig.py --listEmployees
-list vehicles:
python dbConfig.py --listVehicles
-list login history:
python dbConfig.py --listLoginHistory



