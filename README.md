#### Project Idea
1.	User can create an account
2.	User can make a table reservation for a specific date and time, up to one week in advance
3.	Each reservation is for a 1-hour time slot within the restaurant's operating hours (08:00 to 22:00)
4.	User can view their own reservations in the reservation section.
5.	Users can cancel their reservation.
6.  Users are notified if they attempt to make a reservation for a table that is not available or if the desired date is already fully booked

#### Table Structure
1.  Users
    -   id (integer, primary key)
    -   name (string, required)
    -   email (string, required)
    -   email_verified_at (timestamp, nullable)
    -   password (string, required)
    -   remember_token (string, nullable)
    -   created_at (timestamps)
    -   updated_at (timestamps)

2.	Tables
    -	id (integer, primary key)
    -	number (integer, required)
    -	seats (integer, required) - (2 - default, 4, 6)
    -	created_at (timestamps)
    -	updated_at (timestamps)

3.	Reservations
    -	id (integer, primary key)
    -	user_id (integer, foreign key to users)
    -	table_id (integer, foreign key to tables)
    -   start_time (datetime, required) - format HH:00:00
    -   end_time (datetime, required) - format HH:00:00 
    -   date (datetime, required) - format YYYY-MM-DD
    -   created_at (timestamps)
    -	updated_at (timestamps)