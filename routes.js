(function() {
    'use strict';

    angular.module('ballad').config(function($urlRouterProvider, $stateProvider) {

        $urlRouterProvider.otherwise('/');

        $stateProvider
            .state('dashboard', {
                url: '/',
                controller: 'DashboardCtrl',
                templateUrl: 'views/dashboard.html'
            })
            .state('faq', {
                url: '/faq',
                controller: 'DashboardCtrl',
                templateUrl: 'views/faq.html'
            })
            .state('rules', {
                url: '/rules',
                controller: 'DashboardCtrl',
                templateUrl: 'views/rules.html'
            })
            .state('events', {
                url: '/events',
                controller: 'DashboardCtrl',
                templateUrl: 'views/events.html'
            })
            .state('contact', {
                url: '/contact',
                controller: 'DashboardCtrl',
                templateUrl: 'views/contact.html'
            });
    });
})();
