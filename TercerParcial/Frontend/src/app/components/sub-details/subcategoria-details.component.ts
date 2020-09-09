import { Component, OnInit } from '@angular/core';
import { SubcategoriaService } from 'src/app/services/subcategoria.service';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-subcategoria-details',
  templateUrl: './subcategoria-details.component.html'
})
export class SubcategoriaDetailsComponent implements OnInit {
  currentSubcategoria = null;
  message = '';
  constructor(private aspiranteService: SubcategoriaService,
    private route: ActivatedRoute,
    private router: Router) { }

  ngOnInit(): void {
    this.message = '';
    this.getSubcategoria(this.route.snapshot.paramMap.get('id'));
  }

  getSubcategoria(COD_ASPIRANTE): void {
    this.subcategoriaService.get(COD_SUB_CATEGORIA)
      .subscribe(
        data => {
          this.currentSubcategoria = data;
          console.log(data);
        },
        error => {
          console.log(error);
        });
  }

  updateAspirante(): void {
    this.aspiranteService.update(this.currentAspirante.COD_ASPIRANTE, this.currentAspirante)
      .subscribe(
        response => {
          console.log(response);
          this.message = 'Aspirante actualizado correctamente!';
        },
        error => {
          console.log(error);
        });
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
}


