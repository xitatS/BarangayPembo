<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Barangay Pembo - Makati City</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <script>

        function scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
        }

        function toggleMenu() {
            var additionalMenu = document.getElementById('additional-menu');
            additionalMenu.style.display = (additionalMenu.style.display === 'none' || additionalMenu.style.display === '') ? 'block' : 'none';
        }

        function scrollToTop() {
            document.body.scrollTop = 0; 
            document.documentElement.scrollTop = 0; 
        }

        window.onscroll = function () {
            var scrollToTopBtn = document.getElementById("scrollToTopBtn");
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };

        function showHotlinePopup() {
            var hotlinePopup = document.getElementById('hotlinePopup');
            hotlinePopup.style.display = 'block';
        }

        function hideHotlinePopup() {
            var hotlinePopup = document.getElementById('hotlinePopup');
            hotlinePopup.style.display = 'none';
        }

    </script>
</head>
<body>
    <nav>
        <ul>
            <div class="logo">
                <img src="images/pemboLogo.png" alt="Barangay Pembo Logo">
            </div>
            <li><a href="#" onclick="scrollToSection('introSection')">INTRODUCTION</a></li>
            <li><a href="#" onclick="scrollToSection('aboutSection')">ABOUT PEMBO</a></li>
            <li><a href="#" onclick="scrollToSection('populationSection')">POPULATION</a></li>
            <li><a href="#" onclick="scrollToSection('vision&missionSection')">MISSION & VISION</a></li>
            <li class="menu-icon" onclick="toggleMenu()">☰</li>
            <div class="logo2">
                <img src="images/makatiLogo.png" alt="Barangay Pembo Logo">
            </div>
        </ul>
        <ul id="additional-menu" style="display: none;">
            <li><a href="index.php">USER LISTS</a></li>
            <li><a href="Serviceshtml.php">BARANGAY SERVICES</a></li>
            <li><a href="#" onclick="showHotlinePopup()">EMERGENCY HOTLINES</a></li>
        </ul>
    </nav>
                
    <main>
        <div id="contactSection" class="section-container0">
            <div class="section-content">
                <h2>Barangay Pembo</h2><br>
                <p>Located at Blk. 204 L-1&2 Plaza Carriaga Street cor. Sampaguita Street</p>
                <p>Contact: 8856-5672 / 8856-5669 / 8843-4292</p>
            </div>
        </div>

        <div id="introSection" class="section-container1">
            <div class="section-content">
                <h3>Introduction</h3>
                <p>Barangay Pembo is a part of the Second District of Makati. It belongs to the Cluster 5 or the Eastside Cluster together with Comembo, East Rembo, Rizal and West Rembo. The War Tunnel at Morning Glory Street is considered as a heritage site in the Barangay Pembo which is connected to the Fort Bonifacio War Tunnel. Also, Barangay Pembo is where the Ospital ng Makati is located and as its well-known landmark.Pembo is a residential and commercial area and is second to the largest in the district in terms of population. Based on the 2015 Census of Population conducted by the Philippine Statistics Authority (PSA), Pembo has a total of 48,182 population and percentage share of 8.28% of the total population of Makati. By population density on the other hand, considering its land area and population count, the barangay has 75.3 per 1,000 square meters. The barangay is predominantly residential in terms of land use.</p>
            </div>
        </div>

        <div id="aboutSection" class="section-container2">
            <div class="section-content">
                <h3>About Barangay Pembo</h3>
                <p>Pembo used to be a military reservation of the elite Armed Forces of the Philippines cracked unit, the First Ranger Regiment code – named “PANTHERS”. The word “Pembo” only military is an acronym for PANTHERS ENLISTED MEN’S BARRIO.

                Dependents were allowed to reside in Pembo. As the years passed by, the military personnel and their dependents grew by the number, as they built their homes and learned to love the place and improvised structures gradually multiplied. Camp authorities, however, ordered the demolition of some of these structures in the military reservation.
                
                Challenge by the difficult times, some groups of military personnel and their dependents sought the help of higher authorities including the Office of the Makati Mayor to keep their endeared homes.
                
                Cognizant to the plight of these seemingly helpless residents, the Mayor of Makati took their plight and conducted studies on how the insignificant portion of vast and idle military reservation can be segregated and be given to this people. Strong representations were subsequently made with the government agencies concerned including the Office of the President. Fortunate enough, this resulted to the eventual Proclamation no. 2475, awarding this portion of the military reservation lots to the actual occupants, which is now called Barangay PEMBO. Proclamation No. 2475 was later amended by Proclamation No. 518 dated January 31, 1990, limiting the disposition of these lots to bonafide occupants only who are residing in the proclaimed area including boarders or tenants who might be dislocated by any government infrastructure projects.
                
                Barangay PEMBO was so big, even bigger in land area than its neighboring municipality of Pateros. Based on the records of the Urban Development Department (UDD), it has a land area of 639,800 square meters and composed of 14 zones with a population of 48,182 inhabitants based on the 2015 Census of Population survey.
                
                With more than 65,000 inhabitants in 1995 Census of Population, it was before proposed to be divided into 2 barangays pursuant to Paragraph 1, Section 386 of RA 7160 otherwise known as the Local Government Code of 1991. In February 1996, City Ordinance No. 96-010, an Ordinance creating a new Barangay - Barangay Rizal out of Barangay Pembo, principally authored by Hon. Councilor Astolfo C. Pimentel and co-authored by Vice Mayor Arturo S. Yabut and all member of the Sangguniang Panlungsod ng Makati, was enacted and approved.
                
                In 2005, Makati became the country's pioneer in promoting community - based breastfeeding advocacy when it launched the pilot program in Barangay PEMBO, in collaboration with the Center of Health Development of Metro Manila (CHD - MM), the World Health Organization (WHO), the United Nations Children's Fund (UNICEF), and other agencies. The program formed part of national initiative to promote the Philippines as a "Mother and baby- Friendly Country” through the adoption of the National Framework for Infant and Young Child Feed (IYCF).
                
                To date, breastfeeding mothers in Barangay Pembo have received peer counseling of 21 trained volunteers who constituted the support program. After successfully replicating the program in 2006 in two barangays, West Rembo and Pio del Pilar, the Makati Health Department earned a 380,000.00 grant from WHO for the training of volunteers for breastfeeding support groups to further the program expansion in five more barangays of the city.
                
                In preparing all of these, it is important to consider the informal and external condition of the community to be able to address specifically the issues and problems regarding health, peace and order, public safety, economic, education, risk reduction, financial management plan and other social services. To make these factors put in proper context, a reliable plan must be designed based on the actual data gathered from the constituents.</p>
            </div>
        </div>

        <div id="populationSection" class="section-container3">
            <div class="section-content">
                <h3>Barangay Population</h3>
                <p>48,182 (PSA Census 2015)</p>
                <p>52,909 (2020 UDD Projected Population)</p>
                <p>Number of Households: 10,000 Households</p>
                <p>Average Household Size: 5 person/household</p>
                <p>Number of Registered Voters: 32,154</p>
            </div>
        </div>

        <div id="vision&missionSection" class="section-container4">
            <div class="section-content">
                <h3>Mission</h3>
                <p>Barangay Pembo's mission is innovative transformation and global change through adopting modernization and open sourcing, sustainably holistic, morally self- replicating. Highest of good of all solutions founded on comprehensive and modifiable community, models duplicated globally that include sustainable development goals for infrastructure, food, education and arts, peace and order disaster resilience, economics and fulfilled living.</p>
            </div>
        </div>

        <div id="vision&missionSection" class="section-container5">
            <div class="section-content">
                <h3>Vision</h3>
                <p>Barangay Pembo's vision is to be Tourism Hub of Makati City with disciplined and God loving citizens living in sustainable and competitive economy with clean and green environment and disaster-resilient infrastructure led by transparent and accountable public servants.</p>

            </div>
        </div>

        <div id="hotlinePopup" class="popup-container">
            <div class="popup-content">
                <span class="close-popup" onclick="hideHotlinePopup()">&times;</span>
                <h3>Emergency Hotlines</h3><br>
                <p1>__________________________________________________</p1>
                <p>Barangay Pembo Hotline: 8856-5672 / 8856-5669 / 8843-4292</p>
                <p>Ospital ng Makati: (02)8882-6318 / (02)8882-6316</p>
                <p>Headquarters: 0917-127-6214</p>
                <p>Bantay Bayan: 5530-846</p>
            </div>
        </div>

       <button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top">
            <div class="circle-caret">&#8679;</div>
        </button>
    </main>

<footer>
    <h3>Visit Links</h3>
    <p>Connect with us on social media:</p>
    <a href="https://www.facebook.com/MyBarangayPembo" target="_blank" rel="noopener noreferrer">
        <img src="images/facebook-icon.png" alt="Facebook">
        <span>Facebook</span>
    </a>
    <span>&nbsp;l&nbsp;</span>
    <a href="https://x.com//Mayora_Abby" target="_blank" rel="noopener noreferrer">
        <img src="images/twitter-icon.png" alt="Twitter">
        <span>Twitter</span>
    </a>
    <span>&nbsp;l&nbsp;</span>
    <a href="https://www.instagram.com/skpembo" target="_blank" rel="noopener noreferrer">
        <img src="images/instagram-icon.png" alt="Instagram">
        <span>Instagram</span>
    </a>
</footer>

</body>
</html>