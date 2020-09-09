import { Component, OnInit } from '@angular/core';
import { AspiranteService } from 'src/app/services/aspirante.service';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-aspirantes-list',
  templateUrl: './aspirantes-list.component.html',
  styleUrls: ['./aspirantes-list.component.css']
})
export class AspirantesListComponent implements OnInit {

  aspirantes: any;
  currentAspirante = null;
  currentIndex = -1;
  nombre = '';
  cols: any[];

  constructor(private aspiranteService: AspiranteService,
    private route: ActivatedRoute,
    private router: Router) { }

  ngOnInit(): void {
    this.retrieveAspirantes();
    this.cols = [
      { field: 'vin', header: 'NOMBRE' },
      { field: 'year', header: 'APELLIDO' },
      { field: 'brand', header: 'DIRECCION' },
      { field: 'color', header: 'TELEFONO' }
  ];

  }

  retrieveAspirantes(): void {
    this.aspiranteService.getAll()
      .subscribe(
        data => {
          this.aspirantes = data;
          console.log(data);
        },
        error => {
          console.log(error);
        });
  }

  refreshList(): void {
    this.retrieveAspirantes();
    this.currentAspirante = null;
    this.currentIndex = -1;
  }

  setActiveAspirante(aspirante, index): void {
    this.currentAspirante = aspirante;
    this.currentIndex = index;
  }

  deleteAspirante(): void {
    this.aspiranteService.delete(this.currentAspirante.COD_ASPIRANTE)
      .subscribe(
        response => {
          console.log(response);
          this.router.navigate(['/aspirantes']);
        },
        error => {
          console.log(error);
        });
  }

  searchName(): void {
    this.aspiranteService.findByName(this.nombre)
      .subscribe(
        data => {
          this.aspirantes = data;
          console.log(data);
        },
        error => {
          console.log(error);
        });
  }

}
