We decided to encrypt the passwords depending on the version of MYSQL, to make it more secure.

THESE TWO VERSIONS OF THE DATABASE ARE THE SAME (SAME TABLES AND SAME DATA).
The only thing that is different is the encryption of the password.

You can check the version of yours by running the query 'SELECT VERSION()' in MYSQL.

If your MYSQL version is 10.4.11, please use the database of the 10.4.11 folder.

If your MYSQL version is 10.1.37, please use the database of the 10.1.37 folder.

Hopefully, your version will be one of the above ones, as these are the most used versions.

However, if your version is not one of those, you can either:

-Use any of the two databases and encrypt the passwords again using the current version as encryption key

OR

-Send us an email and we will send you an SQL file with the password encrypted for your version.

We did not want to make this harder for you; we thought it would be more secure in a real company.

The passwords are always the same, what changes is only the encryption key.

----------------------------------------------------------------------------------------------------------

The username of any user would be their EMPLOYEE ID / SPECIALIST ID.

To make things easier for us, all the passwords now are the inverse of username.

You can log in with in all the user's accounts easily.

However, here you have usernames and passwords of four users with different roles:

ROLE: MANAGEMENT    USERNAME: 2233      PASSWORD: 3322

ROLE: HELP DESK    USERNAME: 4321      PASSWORD: 1234

ROLE: RESEARCH AND DEVELOPMENT (ANALYST)    USERNAME: 2468      PASSWORD: 8642

ROLE: SPECIALIST    USERNAME: 1115      PASSWORD: 5111