class Cell {
    constructor(number, parent, ticket) {

        this.number = number;
        this.ticket = ticket;
        this.cell = document.createElement('td');
        let textNode = document.createTextNode(number);
        this.cell.appendChild(textNode);
        this.status = 0;
        
        this.cell.classList.add('cell');
        parent.appendChild(this.cell);

        this.cell.onclick = () => this.toggle();

    }

    toggle() { 
        
        if (this.status == 1) {
            this.cell.style.backgroundColor = 'white';
            this.cell.style.color = 'black';
            this.status = 0;
        }
        else if (this.ticket.validate()) {
            this.cell.style.backgroundColor = 'green';
            this.cell.style.color = 'white';
            this.status = 1;
        }

        this.ticket.printSelected();
    }
    
}