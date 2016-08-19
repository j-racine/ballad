(function () {
    'use strict';

    angular.module('ballad').controller('DashboardCtrl', [
        '$scope',
        function($scope) {
            $scope.message = 'Hello World!';
        }
    ]);
}());
