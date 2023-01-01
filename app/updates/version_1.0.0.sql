BEGIN;

-- ERROR;

CREATE SEQUENCE houses_id_sequence;

CREATE TABLE houses
(
    id              INT PRIMARY KEY DEFAULT NEXTVAL('houses_id_sequence'),
    model           VARCHAR(50),
    address         TEXT UNIQUE,
    price_per_month FLOAT,
    rented_status   BIT(1)          DEFAULT B'0',
    created_at      VARCHAR(20)
);

CREATE
    EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE booking
(
    booking_id    VARCHAR(36) PRIMARY KEY DEFAULT uuid_generate_v4(),
    customer_id   VARCHAR(16),
    house_address TEXT,
    house_model   VARCHAR(50),
    duration      INT,
    total_bill    FLOAT,
    end_date      VARCHAR(20),
    created_at    VARCHAR(20),
    FOREIGN KEY (house_address) REFERENCES houses (address)
);

CREATE FUNCTION check_booking_customer_id() RETURNS TRIGGER
    LANGUAGE plpgsql
AS
$FUNCTION$
BEGIN
    IF LENGTH(NEW.customer_id) < 16 THEN
        RAISE EXCEPTION 'Customer ID must has 16 digits length';
    END IF;
    RETURN NEW;
END;
$FUNCTION$;

CREATE TRIGGER check_booking_customer_id
    BEFORE INSERT
    ON booking
    FOR EACH ROW
EXECUTE PROCEDURE check_booking_customer_id();

ROLLBACK;