#### Project Idea
1.	User can create an account
2.	User can view the availability of tables in the restaurant
3.	User can make a table reservation for a specific date and time, up to one week in advance
4.	Each reservation is for a 1-hour time slot within the restaurant's operating hours (08:00 to 22:00)
5.	User can view their own reservations in the reservation section.
6.	Users can cancel their reservation up until the day before the reservation date.

#### Table Structure
1.  Users
    -   id (integer, primary key)
    -   name (string, required)
    -   email (string, required)
    -   password (string, required)
    -   email_verified_at (timestamp, nullable)
    -   remember_token (string, nullable)
    -   created_at (timestamps)

2.	Tables
    -	id (integer, primary key)
    -	number (integer, required)
    -	seats (integer, required) - (2 - default, 4, 6)
    -	created_at (timestamps)

3.	Reservations
    -	id (integer, primary key)
    -	user_id (integer, foreign key to users)
    -	table_id (integer, foreign key to tables)
    -   date_time (datetime, required) - format MM dd YY HH:00 (e.g., 07 13 24 15:00)
    -   created_at (timestamps)