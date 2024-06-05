<?php
use function Laravel\Folio\name;

name('mapping');

?>
<x-guest-layout>
    <x-slot name="title">Mapping Pages</x-slot>
    @include('layouts.leaflet')


    <div class="main-banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container-fluid">
                        <div id="map" class="rounded" style="width: 100%; height: 800px;"></div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="current-location-btn my-4">
                                <button id="locateMeBtn" class="btn btn-light btn-lg">
                                    <i class="fa-solid fa-location-crosshairs"></i>
                                </button>
                            </div>

                            <div class="text-white">
                                Periksa <br>
                                <span>Lokasi saat ini</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section courses" id="courses">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-heading">
                        <h6>Latest Courses</h6>
                        <h2>Latest Courses</h2>
                    </div>
                </div>
            </div>
            <ul class="event_filter">
                <li>
                    <a class="is_active" href="#!" data-filter="*">Show All</a>
                </li>
                <li>
                    <a href="#!" data-filter=".design">Webdesign</a>
                </li>
                <li>
                    <a href="#!" data-filter=".development">Development</a>
                </li>
                <li>
                    <a href="#!" data-filter=".wordpress">Wordpress</a>
                </li>
            </ul>
            <div class="row event_box" style="position: relative; height: 880.844px;">
                <div class="col-lg-4 col-md-6 align-self-center mb-30 event_outer col-md-6 design"
                    style="position: absolute; left: 0px; top: 0px;">
                    <div class="events_item">
                        <div class="thumb">
                            <a href="#"><img src="assets/images/course-01.jpg" alt=""></a>
                            <span class="category">Webdesign</span>
                            <span class="price">
                                <h6><em>$</em>160</h6>
                            </span>
                        </div>
                        <div class="down-content">
                            <span class="author">Stella Blair</span>
                            <h4>Learn Web Design</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 align-self-center mb-30 event_outer col-md-6  development"
                    style="position: absolute; left: 440px; top: 0px;">
                    <div class="events_item">
                        <div class="thumb">
                            <a href="#"><img src="assets/images/course-02.jpg" alt=""></a>
                            <span class="category">Development</span>
                            <span class="price">
                                <h6><em>$</em>340</h6>
                            </span>
                        </div>
                        <div class="down-content">
                            <span class="author">Cindy Walker</span>
                            <h4>Web Development Tips</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 align-self-center mb-30 event_outer col-md-6 design wordpress"
                    style="position: absolute; left: 880px; top: 0px;">
                    <div class="events_item">
                        <div class="thumb">
                            <a href="#"><img src="assets/images/course-03.jpg" alt=""></a>
                            <span class="category">Wordpress</span>
                            <span class="price">
                                <h6><em>$</em>640</h6>
                            </span>
                        </div>
                        <div class="down-content">
                            <span class="author">David Hutson</span>
                            <h4>Latest Web Trends</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 align-self-center mb-30 event_outer col-md-6 development"
                    style="position: absolute; left: 0px; top: 440.422px;">
                    <div class="events_item">
                        <div class="thumb">
                            <a href="#"><img src="assets/images/course-04.jpg" alt=""></a>
                            <span class="category">Development</span>
                            <span class="price">
                                <h6><em>$</em>450</h6>
                            </span>
                        </div>
                        <div class="down-content">
                            <span class="author">Stella Blair</span>
                            <h4>Online Learning Steps</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 align-self-center mb-30 event_outer col-md-6 wordpress development"
                    style="position: absolute; left: 440px; top: 440.422px;">
                    <div class="events_item">
                        <div class="thumb">
                            <a href="#"><img src="assets/images/course-05.jpg" alt=""></a>
                            <span class="category">Wordpress</span>
                            <span class="price">
                                <h6><em>$</em>320</h6>
                            </span>
                        </div>
                        <div class="down-content">
                            <span class="author">Sophia Rose</span>
                            <h4>Be a WordPress Master</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 align-self-center mb-30 event_outer col-md-6 wordpress design"
                    style="position: absolute; left: 880px; top: 440.422px;">
                    <div class="events_item">
                        <div class="thumb">
                            <a href="#"><img src="assets/images/course-06.jpg" alt=""></a>
                            <span class="category">Webdesign</span>
                            <span class="price">
                                <h6><em>$</em>240</h6>
                            </span>
                        </div>
                        <div class="down-content">
                            <span class="author">David Hutson</span>
                            <h4>Full Stack Developer</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
