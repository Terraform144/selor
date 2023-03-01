const chartTemplate = document.createElement('template');
chartTemplate.innerHTML = `
<div style="padding-top:30px;flex-direction:column;height:100vh;width:100%;display:flex !important; align-items:center;/*justify-content:center;*/">
<div><h1>Vos statistiques</h1></div>
<div style="width: 80%;height:80vh;">
    <canvas id="myChart" style=""></canvas>
</div>
</div>
<div style="position:absolute; bottom:95px;left:10px;">
<div class="cercle" style="text-align:left;background-color:rgb(30, 136, 229);" ><span style="padding-left:30px">Correct</span></div>
<div class="cercle" style="text-align:left;background:rgb(255, 100, 100);"><span style="padding-left:30px">Erreur</span></div>
<div class="cercle" style="text-align:left;background:white;"><span style="padding-left:30px">Abstention</span></div>
</div>
<style>
    .cercle {
        width: 20px;
        height: 20px;
        border-radius: 10px;
    }
</style>
`;

class monoChart extends HTMLElement {
    constructor() {
        // Always call super first in constructor
        super();
    }

    connectedCallback() {
        this.attachShadow({ mode: 'open' });
        this.shadowRoot.appendChild(chartTemplate.content);

        if(!_rPoints && !_rErrors) {
           var _rErrors = 10, _rOmmissions = 20, _rPoints = 70;
        }

        const data = {
            datasets: [{
                data: [_rErrors, _rOmmissions, _rPoints],
                backgroundColor: [
                'rgb(255, 100, 100)',
                'rgb(255, 255, 255)',
                'rgb(30, 136, 229)'
                ],
                hoverOffset: 0
            }]
        };
      
        const config = {
          type: 'doughnut',
          data: data,
          options: {}
        };

        const myChart = new Chart(
            this.shadowRoot.getElementById('myChart'),
            config
        );

    }
}

customElements.define('chart-component', monoChart);