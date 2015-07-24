(function() {
  	var app = angular.module('disvolvi', []).config(function($interpolateProvider){
	        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    });

    app.controller('StackOverflowController', ['$scope', '$http', function($scope, $http){

        $scope.request = {}

        $scope.updateQuestions = function(){
            console.log('Update');
        }

        $scope.searchQuestions = function(){
            console.log($scope.request);
        }

    }])
})()
