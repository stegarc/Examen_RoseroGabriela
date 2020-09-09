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
            {label: 'AGREGAR', icon: 'pi pi-fw pi-star', routerLink: ['/add']},
            {
                label: 'SUBCATEGORIA LISTAR', icon: 'pi pi-fw pi-file',  routerLink: ['/subcategorias']
            }
        ];
    }
}
