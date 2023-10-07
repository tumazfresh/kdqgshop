<?php
include 'dbconn.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

?>

<!DOCTYPE html>
<HTML>
<head><?php include('header.php')?>
</head>
<head>
    <title>Warranty Service Centers | KDQG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/warranty_design.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</head>

<body>
    <div class="container">
        <div class="brand-header">
<h2>King Deo and Queen Grace 
<br>Warranty Service Centers</h2>
</div>
        <div class="brand-section">
            <h3 class="brand-title">MI Xiaomi Authorized Service Center</h3>
            <div class="service-center">
                <div class="center-info">
                    <h3>Xiaomi Exclusive Service Center</h3>
                    <p>Address: G/F Market! Market! Mall, 1632 McKinley Pkwy, Taguig, Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 11:00 am - 8:00 pm</p>
                    <p>Contact: <span class="contact">(02) 88736300</span></p>
                </div>
                <div class="center-image">
                    <img src="img/xiaomi-exclusive.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Xiaomi Exclusive Service Center, G/F Market! Market! Mall, 1632 McKinley Pkwy, Taguig, Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Xiaomi Mi Store SM Megamall</h3>
                    <p>Address: 4th floor, Cyberzone Bldg. B SM Megamall, Epifanio de los Santos Ave, Ortigas Center, Mandaluyong, Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 10:00 pm</p>
                    <p>Contact: <span class="contact">(+639)32 223 6889</span></p>
                </div>
                <div class="center-image">
                    <img src="img/mi-store.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Mi Store, 4th floor, Cyberzone Bldg. B SM Megamall, Epifanio de los Santos Ave, Ortigas Center, Mandaluyong, Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Xiaomi Service Center Pasig City</h3>
                    <p>Address: TCI Main, #61, TCI Tower, West Capitol Dr, corner Stella Maris St, Pasig, 1609 Metro Manila</p>
                    <p>Opening Hours: Mon - Fri, 9:00 am -5:00 pm</p>
                    <p>Contact: <span class="contact">(+639)98 967 0783</span></p>
                </div>
                <div class="center-image">
                    <img src="img/xiaomi-service-center.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Xiaomi Service Center, TCI Main, #61, TCI Tower, West Capitol Dr, corner Stella Maris St, Pasig, 1609 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Xiaomi Service Center Quezon City</h3>
                    <p>Address: Floor 3, Gateway Mall, General Roxas Ave, Cubao, Quezon City, 1109 Metro Manila</p>
                    <p>Opening Hours: Mon - Thurs, 10:00 am - 7:00 pm / Fri - Sun, 10:00 am - 8:00 pm</p>
                    </p>
                    <p>Contact: <span class="contact">(+639)17 561 5050</span></p>
                </div>
                <div class="center-image">
                    <img src="img/xiaomi.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Xiaomi, General Roxas Ave, Cubao, Quezon City, 1109 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Xiaomi Store Market Market Taguig City</h3>
                    <p>Address: Xiaomi Store Market Market, Taguig, Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 9:00 pm</p>
                    <p>Contact: <span class="contact">(02) 82413672</span></p>
                
                </div>
                <div class="center-image">
                    <img src="img/xiaomi-store-market-market.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=G3X4+JGR Xiaomi Store Market Market, Taguig, Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Xiaomi Mi Store Trinoma Quezon City</h3>
                    <p>Address: Epifanio de los Santos Ave, Bagong Pag-asa, Quezon City, Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 9:00 pm</p>
                    <p>Contact: <span class="contact">(+639)04 546 8455</span></p>
                
                </div>
                <div class="center-image">
                    <img src="img/mi-store-trinoma.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=M23M+C8C Mi Store Trinoma, Epifanio de los Santos Ave, Bagong Pag-asa, Quezon City, Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>
        </div>

        <div class="brand-section">
            <h3 class="brand-title">Oppo Authorized Service Center</h3>
            <div class="service-center">
                <div class="center-info">
                    <h3>OPPO Service Center SM Manila</h3>
                    <p>Address: CZ-001 Lower G/F SM Manila Arroceros Cor. Brgy. 659 ZONE, 071, San Marcelino St, Ermita, Manila, 1045</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 7:00 pm</p>
                    <p>Contact: <span class="contact">(+639)06 322 6776</span></p>
                </div>
                <div class="center-image">
                    <img src="img/oppo-sm-manila-service.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=OPPO Service Center SM Manila, CZ-0" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>OPPO Service Center Ayala Manila Bay</h3>
                    <p>Address: 4th Floor Space No.4146, Ayala Malls Manila Bay Diosdado Macapagal Boulevard, Corner Aseana Ave, Paranaque City, 1703 Metro Manila</p>
                    <p>Opening Hours: Mon - Fri, 11:00 am - 9:00 pm / Sat - Sun, 10:00 am - 8:00 pm</p>
                    <p>Contact: <span class="contact">(+639)06 501 6776</span></p>
                </div>
                <div class="center-image">
                    <img src="img/oppo-ayala-manila-bay.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=OPPO Service Center Ayala Manila Bay, 4th Floor Space No.4146, Ayala Malls Manila Bay Diosdado Macapagal Boulevard, Corner Aseana Ave, Paranaque City, 1703 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Eton Ortigas OPPO Service Center</h3>
                    <p>Address: Upper Ground Floor Eton Cyberpod Corinthian EDSA corner, Ortigas Ave, Quezon City, 1110 Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 9:00 am - 6:00 pm</p>
                    <p>Contact: <span class="contact">(+639)56 360 6299</span></p>
                </div>
                <div class="center-image">
                    <img src="img/oppo-ortigas.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Eton Ortigas OPPO Service Center, Upper Ground Floor Eton Cyberpod Corinthian EDSA corner, Ortigas Ave, Quezon City, 1110 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>OPPO Service Center North EDSA</h3>
                    <p>Address: AXI 302, 3rd Floor, Cyberzone Annex SM City North, Epifanio de los Santos Ave, Bago Bantay, Quezon City, 1105</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 8:00 pm</p>
                    <p>Contact: <span class="contact">(+639)68 643 0995</span></p>
                </div>
                <div class="center-image">
                    <img src="img/oppo-sm-north.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=OPPO Service Center North EDSA, AXI 302, 3rd Floor, Cyberzone Annex SM City North, Epifanio de los Santos Ave, Bago Bantay, Quezon City, 1105" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>OPPO Service Center The Podium Ortigas</h3>
                    <p>Address: 12 ADB Ave, Ortigas Center, Mandaluyong, 1550 Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 7:00 pm</p>
                    <p>Contact: <span class="contact">(+639)69 012 0005</span></p>
                </div>
                <div class="center-image">
                    <img src="img/oppo-ayala-manila-bay.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=OPPO Service Center The Podium Ortigas, 12 ADB Ave, Ortigas Center, Mandaluyong, 1550 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>
        </div>

        <div class="brand-section">
            <h3 class="brand-title">Realme Authorized Service Center</h3>
            <div class="service-center">
                <div class="center-info">
                    <h3>Realme Service Center Makati City</h3>
                    <p>Address: 4th floor, MJL Building, Makati, 1203 Metro Manila</p>
                    <p>Opening Hours: Mon - Sat, 8:30 am - 5:00 pm</p>
                    <p>Contact: <span class="contact">(+639)164890668</span></p>
                </div>
                <div class="center-image">
                    <img src="img/realme-makati.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=4th floor, realme Service Center Makati, MJL Building, Makati, 1203 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Realme Service Center Quezon City</h3>
                    <p>Address: 2nd floor, Columbian Building, West Ave, Lungsod Quezon, Kalakhang Maynila</p>
                    <p>Opening Hours: Mon - Sat, 9:00 am - 6:00 pm</p>
                    <p>Contact: <span class="contact">(+639)686344605</span></p>
                </div>
                <div class="center-image">
                    <img src="img/realme-quezon.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=2nd floor, realme Service Center Quezon City, Columbian Building, West Ave, Lungsod Quezon, Kalakhang Maynila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Realme Service Center Robinson Metro East</h3>
                    <p>Address: Barangay, Marikina-Infanta Hwy, Pasig, 1600 Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 9:00 pm</p>
                    <p>Contact: <span class="contact">(+639)776524153</span></p>
                </div>
                <div class="center-image">
                    <img src="img/realme-metro-east.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=realme Service Center Robinson Metro East, Barangay, Marikina-Infanta Hwy, Pasig, 1600 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>
        </div>

        <div class="brand-section">
            <h3 class="brand-title">Vivo Authorized Service Center</h3>
            <div class="service-center">
                <div class="center-info">
                    <h3>Vivo Service Center SM City Manila</h3>
                    <p>Address: Vivo Service Center CZ 017 Cyberzone SM City Manila, Concepcion Corner and San Marcelino Streets, Ermita, Manila</p>
                    <p>Opening Hours:  Mon - Sun, 10:00 am - 9:00 pm</p>
                    <p>Contact: <span class="contact">(+639)515626557</span></p>
                </div>
                <div class="center-image">
                    <img src="img/vivo-service-center.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=vivo service center, CZ 017 Cyberzone SM City Manila, Concepcion Corner and, San Marcelino St, Ermita, Manila, Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Metro Manila SM Mega Mall Mandaluyong Vivo Service Center</h3>
                    <p>Address: SM Megamall, Unit 403, 4th Floor Cyberzone, Building B, Epifanio de los Santos Ave, Mandaluyong, Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:10 am - 7:00 pm</p>
                    <p>Contact: <span class="contact">(+639)91 237 1694</span></p>
                </div>
                <div class="center-image">
                    <img src="img/vivo-mega-center.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Vivo Service Center, SM Megamall, Unit 403, 4th Floor Cyberzone, Building B, Epifanio de los Santos Ave, Mandaluyong, Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Vivo Service Center SM Light Mall Mandaluyong City</h3>
                    <p>Address: 129, SM Light Mall, Madison, Mandaluyong, 1560 Metro Manila</p>
                    <p>Opening Hours: Mon - Sat, 10:00 am - 8:45 pm</p>
                    <p>Contact: <span class="contact">(+639)17 848 6111</span></p>
                </div>
                <div class="center-image">
                    <img src="img/vivo-lightmall.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=129, Vivo Service Center, SM Light Mall, Madison, Mandaluyong, 1560 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Vivo Service Center Muntinlupa City</h3>
                    <p>Address: Vivo Service Center, 2nd Level, Expansion Wing 3372.2.1, Festival Mall, Alabang, Muntinlupa, Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 9:00 pm</p>
                    <p>Contact: <span class="contact">(02) 82430045</span></p>
                </div>
                <div class="center-image">
                    <img src="img/vivo-alabang.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Vivo Service Center, vivo service center, 2nd Level, Expansion Wing 3372.2.1, Festival Mall, Alabang, Muntinlupa, Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>
        </div>

        <div class="brand-section">
            <h3 class="brand-title">HP Authorized Service Center</h3>
            <div class="service-center">
                <div class="center-info">
                    <h3>HP Service Center Makati City</h3>
                    <p>Address: Ground, Brgy, Montivar Building, 34 Jupiter, Villages, Makati, 1200 Kalakhang Maynila</p>
                    <p>Opening Hours: Mon - Fri, 8:30 am - 9:00 pm</p>
                    <p>Contact: <span class="contact">(02) 8772 5060</span></p>
                </div>
                <div class="center-image">
                    <img src="img/hp-service-center.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=HP Service Center, Ground, Brgy, Montivar Building, 34 Jupiter, Villages, Makati, 1200 Kalakhang Maynila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>HP Concept Store SM Megamall</h3>
                    <p>Address: Cyberzone 4th Floor, Bldg. B SM Megamall, Mandaluyong City, 8661-hphp, 4747</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 10:00 pm</p>
                    <p>Contact: <span class="contact">(+639)17 879 3756</span></p>
                </div>
                <div class="center-image">
                    <img src="img/hp-megamall.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=HP Concept Store SM MegaMall, Cyberzone 4th Floor, Bldg. B SM Megamall, Mandaluyong City, 8661-hphp, 4747" class="map-link">View on Map</a>
                </div>
            </div>
        </div>

        <div class="brand-section">
            <h3 class="brand-title">Samsung Authorized Service Center</h3>
            <div class="service-center">
                <div class="center-info">
                    <h3>Samsung Service Center SM Megamall</h3>
                    <p>Address: Fourth Floor SM Megamall Ortigas J, Doña Julia Vargas Ave, Mandaluyong, 1550 Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 9:00 pm</p>
                    <p>Contact: <span class="contact">(02) 8671 9283</span></p>
                </div>
                <div class="center-image">
                    <img src="img/samsung-service-center.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Samsung Service Center - Jan Bc Mobile Inc., Fourth Floor SM Megamall Ortigas J, Doña Julia Vargas Ave, Mandaluyong, 1550 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Samsung Service Center - Chronicles Works and Services Santa Ana Manila</h3>
                    <p>Address: Zone 96, Dist. 6, 2424 Tejeron St, Santa Ana, Manila, 1000 Metro Manila</p>
                    <p>Opening Hours: Mon - Sat, 8:30 am - 5:30 pm</p>
                    <p>Contact: <span class="contact">(+639)93 453 4856</span></p>
                </div>
                <div class="center-image">
                    <img src="img/samsung-chronicles.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Samsung Service Center - Chronicles Works and Services, Zone 96, Dist. 6, 2424 Tejeron St, Santa Ana, Manila, 1000 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Samsung Service Center - Primasiana Philippines Makati City</h3>
                    <p>Address: Atrium of Makati, Unit 305 The, Building Makati Ave, Makati, 1224 Metro Manila</p>
                    <p>Opening Hours: Mon - Fri, 9:00 am - 6:00 pm</p>
                    <p>Contact: <span class="contact">(02) 89979440</span></p>
                </div>
                <div class="center-image">
                    <img src="img/samsung-makati.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Samsung Service Center - Primasiana Philippines Makati, Atrium of Makati, Unit 305 The, Building Makati Ave, Makati, 1224 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Samsung Service Center SM City North EDSA</h3>
                    <p>Address: 4th Floor Cyberzone Annex Building SM City North, Epifanio de los Santos Avenue, Quezon City</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 8:00 pm</p>
                    <p>Contact: <span class="contact">(02) 84222111</span></p>
                </div>
                <div class="center-image">
                    <img src="img/samsung-north-edsa.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Samsung Service Center, 4th Floor Cyberzone Annex Building SM City North, Epifanio de los Santos Avenue, Quezon City" class="map-link">View on Map</a>
                </div>
            </div>
        </div>

        <div class="brand-section">
            <h3 class="brand-title">Huawei Authorized Service Center</h3>
            <div class="service-center">
                <div class="center-info">
                    <h3>Huawei Authorized Experience Store SM San Lazaro</h3>
                    <p>Address: Felix Huertas, cor Lacson Ave, Santa Cruz, Manila, Metro Manila</p>
                    <p>Opening Hours: Sun - Thurs, 10:00 am - 9:00 pm / Fri - Sat, 10:00 am - 10:00 pm</p>
                    <p>Contact: <span class="contact">(+639)42 625 7646</span></p>
                </div>
                <div class="center-image">
                    <img src="img/huawei-service-center.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Huawei Authorized Experience Store SM San Lazaro, Felix Huertas, cor Lacson Ave, Santa Cruz, Manila, Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>HUAWEI Authorized Service Center - Mandaluyong City Podium</h3>
                    <p>Address: 3rd Floor, The Podium Mall, Unit 310, ADB Ave, Ortigas Center, Mandaluyong, 1550 Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 9:00 pm</p>
                    <p>Contact: <span class="contact">(+639)17 840 5397</span></p>
                </div>
                <div class="center-image">
                    <img src="img/huawei-mandaluyong.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=HUAWEI Authorized Service Center - Mandaluyong City Podium, 3rd Floor, The Podium Mall, Unit 310, ADB Ave, Ortigas Center, Mandaluyong, 1550 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>HUAWEI Authorized Service Center - Taguig City Venice</h3>
                    <p>Address: Unit A155 & A157 GF Venice Canal Mall, Upper McKinley Rd, Taguig</p>
                    <p>Opening Hours: Mon - Sun, 11:00 am - 10:00 pm / Fri - Sat, 10:00 am - 11:00 pm</p>
                    <p>Contact: <span class="contact">(+639)26 066 9837</span></p>
                </div>
                <div class="center-image">
                    <img src="img/huawei-taguig.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=HUAWEI Authorized Service Center - Taguig City Venice, Unit A155 & A157 GF Venice Canal Mall, Upper McKinley Rd, Taguig" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>HUAWEI Authorized Service Center - Quezon City SM North Edsa</h3>
                    <p>Address: SM North EDSA Annex, Unit 546 5th Floor, Epifanio de los Santos Ave, Quezon City, 1105 Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 8:00 pm</p>
                    <p>Contact: <span class="contact">(+639)68 381 7283</span></p>
                </div>
                <div class="center-image">
                    <img src="img/huawei-north.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=HUAWEI Authorized Service Center - Quezon City SM North Edsa, SM North EDSA Annex, Unit 546 5th Floor, Epifanio de los Santos Ave, Quezon City, 1105 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Huawei Robinsons Place Manila</h3>
                    <p>Address: Pedro Gil St, Ermita, Manila, 1000 Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 9:00 pm /  Fri - Sat, 10:00 am - 10:00 pm</p>
                    <p>Contact: <span class="contact">(+639)49 937 9878</span></p>
                </div>
                <div class="center-image">
                    <img src="img/huawei-robinsons.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=HXGM+3RV Huawei, Pedro Gil St, Ermita, Manila, 1000 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Huawei Authorized Experience Store Glorietta</h3>
                    <p>Address: Huawei Store, Glorietta 2, 3/F Palm Dr, Makati, Metro Manila</p>
                    <p>Opening Hours: Mon - Thurs, 10:00 am - 9:00 pm / Fri - Sun, 10:00 am - 10:00 pm</p>
                    <p>Contact: <span class="contact">(+639)15 674 2189</span></p>
                </div>
                <div class="center-image">
                    <img src="img/huawei-glorietta.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Huawei Authorized Experience Store Glorietta, Huawei Store, Glorietta 2, 3/F Palm Dr, Makati, Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>
        </div>

        <div class="brand-section">
            <h3 class="brand-title">Infinix Authorized Service Center</h3>
            <div class="service-center">
                <div class="center-info">
                    <h3>Carlcare Santa Cruz Manila (Itel, Tecno & Infinix Service Center)</h3>
                    <p>Address: 1st floor, Good Earth Mall Metro Manila, Cariedo Station, Santa Cruz, Manila, 1014 Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 7:00 pm</p>
                    <p>Contact: <span class="contact">(+639)264147875</span></p>
                </div>
                <div class="center-image">
                    <img src="img/infinix-stacruz.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=1st floor, Carlcare St. Cruz Manila (Itel, Tecno & Infinix Service Center), Good Earth Mall Metro Manila, Cariedo Station, Santa Cruz, Manila, 1014 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Infinix Service Center Marikina City</h3>
                    <p>Address: 2nd Floor, Thaddeus Arcade, 2nd floor Unit 5, Mayor Gil Fernando Ave, Marikina, 1800 Metro Manila</p>
                    <p>Opening Hours: Mon - Sat, 9:00 am - 6:00 pm</p>
                    <p>Contact: <span class="contact">(+639)929182605</span></p>
                </div>
                <div class="center-image">
                    <img src="img/infinix-marikina.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=2nd Floor, Infinix Service Center, Thaddeus Arcade, 2nd floor Unit 5, Mayor Gil Fernando Ave, Marikina, 1800 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>
        </div>

        <div class="brand-section">
            <h3 class="brand-title">TECNO Mobile Authorized Service Center</h3>
            <div class="service-center">
                <div class="center-info">
                    <h3>Carlcare Santa Cruz Manila (Itel, Tecno & Infinix Service Center)</h3>
                    <p>Address: 1st floor, Good Earth Mall Metro Manila, Cariedo Station, Santa Cruz, Manila, 1014 Metro Manila</p>
                    <p>Opening Hours: Mon - Sun, 10:00 am - 7:00 pm</p>
                    <p>Contact: <span class="contact">(+639)264147875</span></p>
                </div>
                <div class="center-image">
                    <img src="img/infinix-stacruz.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=1st floor, Carlcare St. Cruz Manila (Itel, Tecno & Infinix Service Center), Good Earth Mall Metro Manila, Cariedo Station, Santa Cruz, Manila, 1014 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>

            <div class="service-center">
                <div class="center-info">
                    <h3>Tecno Service Center SM North Quezon City</h3>
                    <p>Address: SM North, 5th Floor Mediabox SM North Edsa, Annex Building, Epifanio de los Santos Ave, Quezon City, 1100 Metro Manila</p>
                    <p>Opening Hours: Mon - Sat, 9:00 am - 6:00 pm</p>
                    <p>Contact: <span class="contact">(+639)914647467</span></p>
                </div>
                <div class="center-image">
                    <img src="img/tecno-smnor.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=Tecno Service Center, SM North, 5th Floor Mediabox SM North Edsa, Annex Building, Epifanio de los Santos Ave, Quezon City, 1100 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>
        
            <div class="service-center">
                <div class="center-info">
                    <h3>Tecno Service Center Marikina City</h3>
                    <p>Address: 2nd Floor, Thaddeus Arcade, 2nd floor Unit 5, Mayor Gil Fernando Ave, Marikina, 1800 Metro Manila</p>
                    <p>Opening Hours: Mon - Sat, 9:00 am - 6:00 pm</p>
                    <p>Contact: <span class="contact">(+639)929182605</span></p>
                </div>
                <div class="center-image">
                    <img src="img/infinix-marikina.jpg" alt="Service Center Image">
                    <a href="https://maps.google.com/?q=2nd Floor, Infinix Service Center, Thaddeus Arcade, 2nd floor Unit 5, Mayor Gil Fernando Ave, Marikina, 1800 Metro Manila" class="map-link">View on Map</a>
                </div>
            </div>
        </div>
    </div>

    <?php include('slide.php');?>     
    <?php include('footer.php');?>   

    <!-- All Js -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

    <script>

        const notification = document.getElementById('notification');
        const closeButton = notification.querySelector('.notification-close');

        // Add a click event listener to the close button
        closeButton.addEventListener('click', function () {
            notification.style.display = 'none';
        });
    </script>
    <script>
        const notification = document.getElementById('notification');
        const closeButton = notification.querySelector('.notification-close');

        // Add a click event listener to the close button
        closeButton.addEventListener('click', function () {
            notification.style.display = 'none';
        });
    </script>
    
    <script>  
    const notification = document.getElementById('notification');
        const closeButton = notification.querySelector('.notification-close');

    });
    </script>
    
    <script>
    document.querySelector('.announcement-dismiss').addEventListener('click', function() {
        const announcementContainer = document.querySelector('.announcement-container');
        announcementContainer.style.display = 'none';
    });
    </script>

</body>
</html>
