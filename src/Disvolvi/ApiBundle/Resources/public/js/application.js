(function() {
  	var app = angular.module('disvolvi', []).config(function($interpolateProvider){
	        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    });

    app.controller('StackOverflowController', ['$scope', '$http', function($scope, $http){

        var base_url = $('meta[name=base-url]').attr('content');
        console.log(base_url);

        $scope.request = {}

        $scope.updateQuestions = function(){
            $scope.updateSuccess = '';
            $scope.updateError = '';

            $http.get(base_url + 'stack_moblee/v1/update/questions').success(function(data){
          			$scope.updateSuccess = 'Perguntas atualizadas com sucesso';
            }).error(function(){
                $scope.updateError = 'Ouve um erro ao atualizar as perguntas';
            });
        }

        $scope.searchQuestions = function(){
            $scope.searchSuccess = '';
            $scope.searchError = '';
            $scope.questions = [];

            $http.get(base_url + 'stack_moblee/v1/question', { params: $scope.request }).success(function(data){
                $scope.searchSuccess = 'Busca realizada com sucesso';
                $scope.questions = data.content;
            }).error(function(data){
                $scope.searchError = 'Houve um erro ao fazer a busca: "' + data.error + '"';
            });
        }

    }])
})()
