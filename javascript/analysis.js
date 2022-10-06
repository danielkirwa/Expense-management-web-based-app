// analysis 
// get data
var totalExpense = document.querySelector("meta[name=totalExpense]").content;
var billExpense = document.querySelector("meta[name=billExpense]").content;
var shoppingExpense = document.querySelector("meta[name=shoppingExpense]").content;
var savingExpense = document.querySelector("meta[name=savingExpense]").content;



console.log(billExpense);

function createPieChartExpense() {
	// body...
var chartLabels = ["Savings", "Bills", "Shopping"];
var chartValues = [savingExpense, billExpense, shoppingExpense];
var chartColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797"
];

new Chart("graphallcExpense", {
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
      text: "All Expense Comparison"
    }
  }
});
}

function createBarGraphrShoping() {
	// body...
var chartLabels = ["Total Expense", "Shopping Expense","Trend"];
var chartValues = [totalExpense, shoppingExpense, 0];
var chartColors = [
  "#b91d47",
  "#00aba9",
  "#ffffff"
];

new Chart("barGraphShopping", {
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
      text: "Shopping vs Tota  Expense"
    }
  }
});
}

function createBarGraphrBills() {
	// body...
var chartLabels = ["Total Expense", "Bills","Trend"];
var chartValues = [totalExpense, billExpense,0];
var chartColors = [
  "#b91d47",
  "#233637",
  "#ffffff"
];

new Chart("barGraphBills", {
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
      text: "Bills vs Total Expense"
    }
  }
});
}
function createBarGraphSavings() {
  // body...
var chartLabels = ["Total Expense", "Savings","Trend"];
var chartValues = [totalExpense, savingExpense,0];
var chartColors = [
  "#b91d47",
  "#2b5797",
  "#ffffff"
];

new Chart("barGraphSavings", {
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
      text: "Savings vs Total Expense"
    }
  }
});
}
createBarGraphrShoping() ;
createBarGraphrBills();
createPieChartExpense();
createBarGraphSavings()

