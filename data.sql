INSERT INTO zones (zone_name, max_spots, rate)
VALUES	
    ('StateHouse', 200, 10.00),
    ('ShortNorth', 100, 8.00),
    ('NorthMarket', 50, 5.00);



INSERT INTO venues (venue_name)
VALUES
    ('Nationwide Arena'),
    ('COSI'),
    ('Huntington Park');




INSERT INTO distances (zone_name, venue_name, miles)
VALUES
    ('StateHouse', 'Nationwide Arena', 1),
    ('StateHouse', 'COSI', 4),
    ('StateHouse', 'Huntington Park', 3),
    ('ShortNorth', 'Nationwide Arena', 2),
    ('ShortNorth', 'COSI', 5),
    ('ShortNorth', 'Huntington Park', 4),
    ('NorthMarket', 'Nationwide Arena', 2),
    ('NorthMarket', 'COSI', 4),
    ('NorthMarket', 'Huntington Park', 2);

INSERT INTO events 
VALUES
   (0,'Concert','2023-11-30',1),
   (0,'Concert','2023-12-27',2),
   (0,'Concert','2023-11-27',3),
   (0,'Concert','2023-12-1',2)