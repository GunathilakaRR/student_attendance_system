{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <h1>Curriculum Vitae</h1>
    <h2>Personal Information</h2>
    <p><strong>Name:</strong> {{ $data['firstName'] }} {{ $data['lastName'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>About me:</strong>{{ $data['aboutYou'] }}</p>
    </div>

</body>
</html> --}}





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
    <section class="main-section">
        <div class="left-part">
            <div class="photo-container">
                <img src="https://images.ctfassets.net/h6goo9gw1hh6/2sNZtFAWOdP1lmQ33VwRN3/24e953b920a9cd0ff2e1d587742a2472/1-intro-photo-final.jpg?w=1200&h=992&fl=progressive&q=70&fm=jpg" alt="">
            </div>
            <div class="contact-container">
                <h2 class="title">{{ $data['firstName'] }}</h2>
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

</body>

</html>
