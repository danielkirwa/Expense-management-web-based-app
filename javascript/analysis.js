// analysis 
// get data
var totalExpense = document.querySelector("meta[name=totalExpense]").content;
var billExpense = document.querySelector("meta[name=billExpense]").content;
var shoppingExpense = document.querySelector("meta[name=shoppingExpense]").content;
var savingExpense = document.querySelector("meta[name=savingExpense]").content;



console.log(billExpense);

function createPieChart() {
	// body...
var chartLabels = ["Savings", "Bills", "Shopping"];
var chartValues = [savingExpense, billExpense, shoppingExpense];
var chartColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797"
];

new Chart("graphallcases", {
  type: "pie",
  data: {
    labels: chartLabels,
    datasets: [{
      backgroundColor: chartColors,
      data: chartValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "ALL CRIMES"
    }
  }
});
}

function createBarGraph() {
	// body...
var chartLabels = ["Expert", "Intermediate", "Beginner","null"];
var chartValues = [55, 49, 44,0];
var chartColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#fff"
];

new Chart("barGraphResults", {
  type: "bar",
  data: {
    labels: chartLabels,
    datasets: [{
      backgroundColor: chartColors,
      data: chartValues
    }]
  },
  options: {
  	legend: {display: false},
    title: {
      display: true,
      text: "AVARAGE SCORES"
    }
  }
});
}

function createBarGraphrReport() {
	// body...
var chartLabels = ["Active", "Completed", "Inactive","Fail"," "];
var chartValues = [55, 49, 44,12,0];
var chartColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#233637",
  "#fff"
];

new Chart("barGraphUnitReport", {
  type: "bar",
  data: {
    labels: chartLabels,
    datasets: [{
      backgroundColor: chartColors,
      data: chartValues
    }]
  },
  options: {
  	legend: {display: false},
    title: {
      display: true,
      text: "GENERAL TRENDS"
    }
  }
});
}

createBarGraphrReport() ;
createBarGraph();
createPieChart();

