# Sonata RUBY
CRM PHP. Easy install

	Install form .git

		git clone https://github.com/sonataruby/code-ci ./

	go to http://domain.com/install

	enter database and admin info
	
	Save and finish

##Sql Mode
	set global sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
	set session sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
##MAMPP Pro
	Disable MySQL Strict Mode MAMP PRO
	1. In MAMP Pro, go to File -> Edit Template -> MySQL (my.cnf) -> (your version)

	2. Find [mysqld]

	3. Add the following line immediately below [mysqld]: sql_mode=""

	https://mampsupportforum.com/forums/latest/mamp-mamp-pro-disable-mysql-strict-mode
