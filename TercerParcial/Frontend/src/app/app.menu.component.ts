import { Component, OnInit } from '@angular/core';
import { AppMainComponent } from './app.main.component';

@Component({
    selector: 'app-menu',
    templateUrl: './app.menu.component.html'
})
export class AppMenuComponent implements OnInit {

    model: any[];

    constructor(public app: AppMainComponent) {}

    ngOnInit() {
        this.model = [            
            {
                label: 'SUB CATEGORIA', icon: 'pi pi-fw pi-file',  routerLink: ['/subcategoria']
            }
        ];
    }
}
