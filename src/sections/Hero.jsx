import React, { useEffect, useState } from 'react'

const Hero = () => {

    const [yearsOfExperience, setYearsOfExperience] = useState(4);

    useEffect(() => {
        const currentYear = new Date().getFullYear();
        const startYear = 2020;
        const years = currentYear - startYear;
        setYearsOfExperience(years);
    }, []);

  return (
    <section className="h-hero">
        <div className="wrapper">
            <div className="h-hero__top">
                <div className="h-hero__title">
                    <h1>
                        <span className="text-hidden">Wendale Dy </span>
                        <span>Software Engineer</span>
                    </h1>
                </div>
                <div className="h-hero__sub">
                    <p> specializing in Web Development, Mobile App Development, and Project Management. With a blend of technical expertise and strategic insight, I craft tailored solutions to bring your digital projects to life.</p>
                </div>
            </div>
            <div className="h-hero__bottom">
            <div id="about" className="h-hero__text">
                <p>Hello there! I'm Wendale Franz R. Dy, a seasoned software engineer with over {yearsOfExperience} years of experience, committed to crafting innovative solutions and enhancing digital experiences.</p>
                <a href="mailto:wendalefranz.dy@gmail.com" className="button">
                    <span className="button__text">Drop me a line</span>
                    <div className="button__icon">
                        <div className="button__icon__bg"></div>
                            <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m7.012 18.069 9.702-9.702v7.298l1.499.028-.014-8.81-1.132-1.132-8.81-.014.028 1.499h7.298L5.88 16.937l1.131 1.132Z" fill="currentColor"></path></svg>
                    </div>
                </a>
                <br/>
                <br/>
                <a href="https://drive.google.com/file/d/1I3BhOTZj4oI2yp7tqYpwiecQrnetmf0m/view?usp=sharing" target="_blank" className="button">
                    <span className="button__text">View CV</span>
                    <div className="button__icon">
                        <div className="button__icon__bg"></div>
                            <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m7.012 18.069 9.702-9.702v7.298l1.499.028-.014-8.81-1.132-1.132-8.81-.014.028 1.499h7.298L5.88 16.937l1.131 1.132Z" fill="currentColor"></path></svg>
                    </div>
                </a>
            </div>
            <ul className="h-hero__social">
                <li>
                    <span>Let's get connected</span>
                </li>
                <li>
                    <a href="https://www.instagram.com/wfrdee" target="_blank" className="text-link">
                        <span>Instagram</span>
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/wfrdee" target="_blank" className="text-link">
                        <span>Facebook</span>
                    </a>
                </li>
                <li>
                    <a href="https://nibbleph.dev" target="_blank" className="text-link">
                        <span>Website</span>
                    </a>
                </li>
                <li>
                    <a href="https://github.com/sheeshcake" target="_blank" className="text-link">
                        <span>Github</span>
                    </a>
                </li>
                <li>
                    <a href="https://drive.google.com/file/d/1I3BhOTZj4oI2yp7tqYpwiecQrnetmf0m/view?usp=sharing" target="_blank" className="text-link">
                        <span>My CV</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
  )
}

export default Hero
