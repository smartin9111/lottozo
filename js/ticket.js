class Ticket {
    constructor(){
        this.cells = []
        this.table = document.createElement('table');
        this.table.id = 'szelveny_table';
        let row;
        for ( let i = 1 ; i <= 45 ; i++) {
            let colId = (i-1) % 9;
            if (colId == 0) {
                row = document.createElement('tr')
                this.table.appendChild(row);
            }

            let cell = new Cell(i, row, this);
            this.cells.push(cell);
        }

        document.getElementById('szelveny_div').appendChild(this.table);
    }

    validate() {
        return this.cells.map(c => c.status).reduce((a,b) => a+b) < 6;
    }

    printSelected() {
        let numberRow = document.getElementById('szamlist');
        numberRow.innerHTML = this.cells.filter(c => c.status == 1).map(c => c.number).reduce((a, b) => a + ", " + b);
    }
}