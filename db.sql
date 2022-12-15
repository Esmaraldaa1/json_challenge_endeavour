--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
                            `account` varchar(30) NOT NULL,
                            `name` text NOT NULL,
                            `address` text NOT NULL,
                            `checked` tinyint(1) NOT NULL,
                            `description` text NOT NULL,
                            `interest` text,
                            `date_of_birth` date DEFAULT NULL,
                            `email` varchar(150) NOT NULL,
                            `credit_card_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;


--
-- Table structure for table `credit_card`
--

CREATE TABLE `credit_card` (
                               `id` int NOT NULL,
                               `type` varchar(30) NOT NULL,
                               `number` varchar(30) NOT NULL,
                               `name` text NOT NULL,
                               `expiration_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;
