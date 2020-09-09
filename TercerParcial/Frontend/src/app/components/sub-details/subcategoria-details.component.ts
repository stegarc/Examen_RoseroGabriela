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
  constructor(private subcategoriaService: SubcategoriaService,
    private route: ActivatedRoute,
    private router: Router) { }

  ngOnInit(): void {
    this.message = '';
    this.getSubcategoria(this.route.snapshot.paramMap.get('id'));
  }

  getSubcategoria(COD_SUB_CATEGORIA): void {
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

  updateSubcategoria(): void {
    this.subcategoriaService.update(this.currentSubcategoria.COD_SUB_CATEGORIA, this.currentSubcategoria)
      .subscribe(
        response => {
          console.log(response);
          this.message = 'Subcategoria actualizado correctamente!';
        },
        error => {
          console.log(error);
        });
  }

  deleteSubcategoria(): void {
    this.subcategoriaService.delete(this.currentSubcategoria.COD_SUB_CATEGORIA)
      .subscribe(
        response => {
          console.log(response);
          this.router.navigate(['/subcategorias']);
        },
        error => {
          console.log(error);
        });
  }
}


