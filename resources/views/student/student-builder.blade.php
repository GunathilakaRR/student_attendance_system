<x-app-layout>



    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Side Navigation Bar</title>
        <link rel="stylesheet" href="student_dashboard.css">
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <style>
            @import url('https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style: none;
  text-decoration: none;
  font-family: 'Josefin Sans', sans-serif;
}

body{
   background-color: #f3f5f9;
}

.wrapper{
  display: flex;
  position: relative;
}

.wrapper .sidebar{
  width: 200px;
  height: 100%;
  background: #594f8d;
  padding: 30px 0px;
  position: fixed;
}

.wrapper .sidebar h2{
  color: #fff;
  text-transform: uppercase;
  text-align: center;
  margin-bottom: 30px;
}

.wrapper .sidebar ul li{
  padding: 15px;
  border-bottom: 1px solid #bdb8d7;
  border-bottom: 1px solid rgba(0,0,0,0.05);
  border-top: 1px solid rgba(255,255,255,0.05);
}

.wrapper .sidebar ul li a{
  color: #bdb8d7;
  display: block;
}

.wrapper .sidebar ul li a .fas{
  width: 25px;
}

.wrapper .sidebar ul li:hover{
  background-color: #594f8d;
}

.wrapper .sidebar ul li:hover a{
  color: #fff;
}

.wrapper .sidebar .social_media{
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
}

.wrapper .sidebar .social_media a{
  display: block;
  width: 40px;
  background: #594f8d;
  height: 40px;
  line-height: 45px;
  text-align: center;
  margin: 0 5px;
  color: #bdb8d7;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}

.wrapper .main_content{
  width: 100%;
  margin-left: 200px;
}

.wrapper .main_content .header{
  padding: 20px;
  background: #fff;
  color: #717171;
  border-bottom: 1px solid #e0e4e8;
}

.wrapper .main_content .info{
  margin: 20px;
  color: #717171;
  line-height: 25px;
}

.wrapper .main_content .info div{
  margin-bottom: 20px;
}

        </style>
    </head>


    <body>


    <div class="wrapper">
        <div class="sidebar">
            <h2>{{ Auth::user()->name1 }}</h2>
            <h2>{{ Auth::user()->registration_number }}</h2>
            <ul>
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="#"><i class="fas fa-user"></i>Profile</a></li>
                <li><a href="#"><i class="fas fa-address-card"></i>About</a></li>
                <li><a href="{{ route('student-cvbuilder') }}"><i class="fas fa-project-diagram"></i>CV Builder</a></li>
                <li><a href="#"><i class="fas fa-blog"></i>Blogs</a></li>
                <li><a href="#"><i class="fas fa-address-book"></i>Contact</a></li>
                <li><a href="#"><i class="fas fa-map-pin"></i>Map</a></li>
            </ul>
            <div class="social_media">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        <div class="main_content">
            <div class="header">Lets build your CV </div>
            <div class="container">
                {{-- <form method="POST" action="{{ route('generate.cv') }}"> --}}
                <form onsubmit="event.preventDefault(); generateCV();">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputFirstName">First Name</label>
                            <input type="text" name="firstName" class="form-control" id="inputFirstName" value="{{ Auth::user()->student->name1 }}"
                            >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputLastName">Last Name</label>
                            <input type="text" name="lastName" class="form-control" id="inputLastName" value="{{ Auth::user()->student->name2 }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputTele">Telephone Number</label>
                            <input type="integer" name="teleNumber" class="form-control" id="inputTele">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" name="city" class="form-control" id="inputCity">
                        </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail4" value="{{ Auth::user()->email }}">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputLinkedin">Linkedin Account</label>
                        <input type="text" name="linkedin" class="form-control" id="inputLinkedin" placeholder="Linkedin">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputGithub">Github Account</label>
                        <input type="text" name="github" class="form-control" id="inputGithub" placeholder="Github">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label for="exampleFormControlTextarea1">About You</label>
                        <textarea class="form-control" name="aboutYou" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="exampleFormControlTextarea1">Tech Skills</label>
                        <textarea class="form-control" name="techSkills" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleFormControlTextarea1">Soft Skills</label>
                        <textarea class="form-control" name="softSkills" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="exampleFormControlTextarea1">Educational Qualifications</label>
                        <textarea class="form-control" name="qualification" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleFormControlTextarea1">Projects</label>
                        <textarea class="form-control" name="projects" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Generate CV</button>


                  </form>
            </div>


        </div>
    </div>

    </body>



    <script>
        // Function to generate and open CV in new tab
        function generateCV() {
            // Get form inputs
            var firstName = document.getElementById('inputFirstName').value;
            var lastName = document.getElementById('inputLastName').value;
            // Get other form inputs similarly

            // Generate CV HTML content
            var cvContent = `
            <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <title>Resume</title>


    <style>
        /* Google Fonts  */
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');
/* font-family: 'Open Sans', sans-serif; */

@import url('https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
/* font-family: 'Public Sans', sans-serif; */

@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');
/* font-family: 'Lato', sans-serif; */

@page {
            size: A4;
            margin: 2cm; /* Adjust margins as needed */
        }

*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body{
    background-color: #EBECF0;
}

.main-section{
    width: 210mm;
    height: 297mm;
    background-color: white;
    margin: 0 auto;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    display: flex;
}

.main-section .left-part{
    width: 40%;
    height: 100%;
    background-color: #F4F4F4;
    padding: 2.8rem;
}

.left-part .photo-container{
    margin-bottom: 2.2rem;
}

.left-part .photo-container img{
    width: 200px;
    height: 200px;
    border-radius: 50%;
    object-fit: contain;
    border: 10px solid white;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}

.title{
    font-family: 'Public Sans', sans-serif;
    font-size: 1.4rem;
    text-transform: uppercase;
    padding: 0.6rem;
    background-color: #444440;
    color: white;
    text-align: center;
    margin: 1.4rem 0;
}

.contact-container{
    margin-bottom: 2.2rem;
}

.contact-container .contact-list{
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    font-family: 'Lato', sans-serif;
    color: #444440;
    font-size: 1rem;
}

.education-container{
    margin-bottom: 2.2rem;
    font-family: 'Lato', sans-serif;
}

.education-container .course{
    margin-bottom: 1rem;
    color: #414042;
}

.education-container .education-title{
    font-size: 1rem;
    font-weight: 800;
    margin-bottom: .3rem;
}

.education-container .college-name{
    margin-bottom: 0.3rem;
    font-weight: 600;

}

.education-container .education-date{
    font-size: 0.9rem;
}

.skills-container .skill{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.6rem;
    font-family: 'Lato', sans-serif;
}

.skills-container .skill .right-skill .outer-layer{
    background-color: #BBBBBB;
    height:0.4rem;
    width: 5rem;
    border-radius: 0.4rem;
}

.skills-container .skill .right-skill .inner-layer{
    background-color: #3D3D3D;
    height: 100%;
    border-radius: inherit;
}

.right-part{
    padding: 2.8rem;
}

.right-part .banner{
    font-family: 'Open Sans', sans-serif;
    color: #4D4D4F;
    margin-bottom: 2.2rem;
}

.right-part .banner .firstname{
    font-size: 4rem;
}

.right-part .banner .lastname{
    font-size: 4rem;
    font-weight: 400;
    letter-spacing: 0.5rem;
    margin-top: -1rem;
}

.right-part .banner .position{
    letter-spacing: 0.3rem;
    margin-top: -0.5rem;
    font-size: 1.1rem;
}

.work-container{
    margin-top: 5rem;
    font-family: 'Lato', sans-serif;
}

.work-container .work:not(:last-child){
    margin-bottom: 1.8rem;
}

.work-container .work .job-date{
    display: flex;
    justify-content: space-between;
    color: #4D4D4F;
    margin-bottom: 0.5rem;
    font-size: 0.7rem;
    font-weight: 500;
}

.work-container .work .company-name{
    font-size: 0.9rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #4D4D4F;

}

.work-container .work .work-text{
    color: #737373;
    font-size: 0.8rem;
    text-align: justify;
    line-height: 1rem;
}

.references-container .references{
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
    font-family: 'Lato', sans-serif;
    color: #4D4D4F;
}

.references-container .references .name{
    font-weight: 800;
    font-size: 1.1rem;
}

.references-container .references .company-name{
    margin: 0.5rem 0;
    font-size: 0.9rem;
}

.references-container .references .phone{
    display: flex;
    justify-content: space-between;
    font-size: 0.7rem;
    color: #414042;
}
.references-container .references .phone p{
    margin: 0.4rem 0;
}

.references-container .references .phone .phone-text{
    font-weight: 600;
}

.text-left{
    text-align: left;
}
    </style>
</head>

<body>
    <section class="main-section" id="cv-template">
        <div class="left-part">
            <div class="photo-container">
                <img src="https://images.ctfassets.net/h6goo9gw1hh6/2sNZtFAWOdP1lmQ33VwRN3/24e953b920a9cd0ff2e1d587742a2472/1-intro-photo-final.jpg?w=1200&h=992&fl=progressive&q=70&fm=jpg" alt="">
            </div>
            <div class="contact-container">
                <h2 class="title">${firstName}</h2>
                <div class="contact-list">
                    <div class="icon-container">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div class="contact-text">
                        <p>123 Anywhere St., Any City, ST 12345</p>
                    </div>
                </div>
                <div class="contact-list">
                    <div class="icon-container">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div class="contact-text">
                        <p>hello@reallygreatsite.com</p>
                    </div>
                </div>
                <div class="contact-list">
                    <div class="icon-container">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <div class="contact-text">
                        <p>www.reallygreatsite.com</p>
                    </div>
                </div>
                <div class="contact-list">
                    <div class="icon-container">
                        <i class="bi bi-linkedin"></i>
                    </div>
                    <div class="contact-text">
                        <p>@reallygreatsite</p>
                    </div>
                </div>
            </div>

            <div class="education-container">
                <h2 class="title">Education</h2>
                <div class="course">
                    <h2 class="education-title">Course Studied</h2>
                    <h5 class="college-name">University/College Details</h5>
                    <p class="education-date">2006 - 2008</p>
                </div>
                <div class="course">
                    <h2 class="education-title">Course Studied</h2>
                    <h5 class="college-name">University/College Details</h5>
                    <p class="education-date">2006 - 2008</p>
                </div>
                <div class="course">
                    <h2 class="education-title">Course Studied</h2>
                    <h5 class="college-name">University/College Details</h5>
                    <p class="education-date">2006 - 2008</p>
                </div>
            </div>

            <div class="skills-container">
                <h2 class="title">Skills</h2>
                <div class="skill">
                    <div class="left-skill">
                        <p>Skill Name 01</p>
                    </div>
                    <div class="right-skill">
                        <div class="outer-layer">
                            <div class="inner-layer" style="width: 60%;"></div>
                        </div>
                    </div>
                </div>
                <div class="skill">
                    <div class="left-skill">
                        <p>Skill Name 01</p>
                    </div>
                    <div class="right-skill">
                        <div class="outer-layer">
                            <div class="inner-layer" style="width: 90%;"></div>
                        </div>
                    </div>
                </div>
                <div class="skill">
                    <div class="left-skill">
                        <p>Skill Name 02</p>
                    </div>
                    <div class="right-skill">
                        <div class="outer-layer">
                            <div class="inner-layer" style="width: 40%;"></div>
                        </div>
                    </div>
                </div>
                <div class="skill">
                    <div class="left-skill">
                        <p>Skill Name 03</p>
                    </div>
                    <div class="right-skill">
                        <div class="outer-layer">
                            <div class="inner-layer" style="width: 60%;"></div>
                        </div>
                    </div>
                </div>
                <div class="skill">
                    <div class="left-skill">
                        <p>Skill Name 04</p>
                    </div>
                    <div class="right-skill">
                        <div class="outer-layer">
                            <div class="inner-layer" style="width: 70%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-part">
            <div class="banner">
                <h1 class="firstname">Mariana</h1>
                <h1 class="lastname">Anderson</h1>
                <p class="position">Marketing Manager</p>
            </div>

            <div class="work-container ">
                <h2 class="title text-left">work experience</h2>
                <div class="work">
                    <div class="job-date">
                        <p class="job">Job position here</p>
                        <p class="date">2019 - 2022</p>
                    </div>
                    <h2 class="company-name">Company Name l Location</h2>
                    <p class="work-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam pharetra in
                        lorem
                        at laoreet. Donec hendrerit libero eget est tempor, quis tempus arcu elementum. In elementum
                        elit at
                        dui tristique feugiat. Mauris convallis, mi at mattis malesuada, neque nulla volutpat dolor,
                        hendrerit faucibus eros nibh ut nunc. Proin luctus urna i</p>
                </div>

                <div class="work">
                    <div class="job-date">
                        <p class="job">Job position here</p>
                        <p class="date">2019 - 2022</p>
                    </div>
                    <h2 class="company-name">Company Name l Location</h2>
                    <p class="work-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam pharetra in
                        lorem
                        at laoreet. Donec hendrerit libero eget est tempor, quis tempus arcu elementum. In elementum
                        elit at
                        dui tristique feugiat. Mauris convallis, mi at mattis malesuada, neque nulla volutpat dolor,
                        hendrerit faucibus eros nibh ut nunc. Proin luctus urna i</p>
                </div>
                <div class="work">
                    <div class="job-date">
                        <p class="job">Job position here</p>
                        <p class="date">2019 - 2022</p>
                    </div>
                    <h2 class="company-name">Company Name l Location</h2>
                    <p class="work-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam pharetra in
                        lorem
                        at laoreet. Donec hendrerit libero eget est tempor, quis tempus arcu elementum. In elementum
                        elit at
                        dui tristique feugiat. Mauris convallis, mi at mattis malesuada, neque nulla volutpat dolor,
                        hendrerit faucibus eros nibh ut nunc. Proin luctus urna i</p>
                </div>
            </div>

            <div class="references-container">
                <h2 class="title text-left">References</h2>
                <div class="references">
                    <div class="left-references">
                        <h4 class="name">Name Surname</h4>
                        <p class="company-name">Job position, Company Name</p>
                        <div class="phone">
                            <div class="phone-text">
                                <p>Phone:</p>
                                <p>Email:</p>
                            </div>
                            <div class="phone-number">
                                <p>123-456-7890</p>
                                <p>hello@reallygreatsite.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="right-references">
                        <h4 class="name">Name Surname</h4>
                        <p class="company-name">Job position, Company Name</p>
                        <div class="phone">
                            <div class="phone-text">
                                <p>Phone:</p>
                                <p>Email:</p>
                            </div>
                            <div class="phone-number">
                                <p>123-456-7890</p>
                                <p>hello@reallygreatsite.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <button onclick="downloadCV()">Download PDF</button>
</body>


</html>


            `;

            // Open CV in new tab
            var cvWindow = window.open();
            cvWindow.document.open();
            cvWindow.document.write(cvContent);
            cvWindow.document.close();



        }




    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>




    </html>

</x-app-layout>
