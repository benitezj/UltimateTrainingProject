**FUNCTIONALITY**:

- register new vehicles, 
- search for vehicle owners, 
- send automatic email messages within the company domain
- list incident history
- Secure Login:
  * users must be registered in the database
  * login times out after 10 minutes
  * user account is locked after 5 login attempts in 1 minute or 15 in 1 day.
- Admin account 'ultimate', registered by default for:
  * adding new users
  * registering new employees 

**INSTALLATION**:

1. MySQL, PHP5, python, python-mysql, should be installed on host
2. Ap initialization:
  - create the database and tables: `python dbConfig.py --createDB`
  - create admin account: `python dbConfig.py --createDBuser`
  - If running above steps again one needs to add the --force option.
3. (optional) 
  - Load users: `python dbConfig.py --loadApUsers UsersData.txt`
  - Load employees: `python dbConfig.py --loadEmployees EmployeeData.txt`
  - Load vehicles: `python dbConfig.py --loadVehicles VehicleData.txt`
4. Move ReceptionHelperAp folder to public web space.

**COMMAND LINE TOOLS**:

- list Ap users: `python dbConfig.py --listApUsers`
- list employees: `python dbConfig.py --listEmployees`
- list vehicles:  `python dbConfig.py --listVehicles`
- list login history: `python dbConfig.py --listLoginHistory`



