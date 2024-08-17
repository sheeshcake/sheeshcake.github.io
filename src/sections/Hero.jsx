import React from 'react'

const Hero = () => {
  return (
    <section class="h-hero">
        <div class="wrapper">
            <div class="h-hero__top">
                <div class="h-hero__title">
                    <h1>
                        <span class="text-hidden">Wendale Dy </span>
                        <span>Software Engineer</span>
                    </h1>
                </div>
                <div class="h-hero__sub">
                    <p>specialized in Web Development, Mobile App Development and Project Management</p>
                </div>
            </div>
            <div class="h-hero__bottom">
            <div id="about" class="h-hero__text">
                <p>Hi! I'm Wendale Franz R. Dy a software engineer based in the Philippines, with a degree of Computer Science.</p>
                <a href="mailto:wendalefranz.dy@gmail.com" class="button">
                    <span class="button__text">Drop me a line</span>
                    <div class="button__icon">
                        <div class="button__icon__bg"></div>
                            <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m7.012 18.069 9.702-9.702v7.298l1.499.028-.014-8.81-1.132-1.132-8.81-.014.028 1.499h7.298L5.88 16.937l1.131 1.132Z" fill="currentColor"></path></svg>
                    </div>
                </a>
            </div>
            <ul class="h-hero__social">
                <li>
                    <span>Let's get connected</span>
                </li>
                <li>
                    <a href="https://www.instagram.com/wfrdee" target="_blank" class="text-link">
                        <span>Instagram</span>
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/wfrdee" target="_blank" class="text-link">
                        <span>Facebook</span>
                    </a>
                </li>
                <li>
                    <a href="https://nibbleph.dev" target="_blank" class="text-link">
                        <span>Website</span>
                    </a>
                </li>
                <li>
                    <a href="https://github.com/sheeshcake" target="_blank" class="text-link">
                        <span>Github</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
  )
}

export default Hero