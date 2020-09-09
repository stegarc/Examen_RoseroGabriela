import { Component, OnInit } from '@angular/core';
import { SubcategoriaService } from 'src/app/services/subcategoria.service';
import { ActivatedRoute, Router } from '@angular/router';
import { Subcategoria } from 'src/app/models/subcategoria';
import { CategoriaService } from 'src/app/services/categoria.service';
import { Categoria } from 'src/app/models/categoria';


@Component({
  selector: 'app-subcategorias-list',
  templateUrl: './subcategorias-list.component.html',
  styleUrls: ['./subcategorias-list.component.css']
})
export class SubcategoriasListComponent implements OnInit {
  categorias: any = [];
  currentCategoria = null;
  categoria = {
    COD_CATEGORIA: '',
    DESCRIPCION: ''
  };
    subcategorias: any = [];
  currentSubcategoria = null;
  currentIndex = -1;
  subcategoria: Subcategoria;

  constructor(private subcategoriaService: SubcategoriaService,
    private route: ActivatedRoute,
    private router: Router, private categoriaService: CategoriaService) { }

  ngOnInit(): void {
    this.retrieveSubcategorias();    
    this.retrieveCategorias();
    this.subcategoria = new Subcategoria();
    this.categoria = new Categoria();
  }

  
  retrieveCategorias(): void {
    this.categoriaService.getAll()
      .subscribe(
        res => {
          this.categorias = res;
        },
        err => console.error(err)
      );
  }
  retrieveSubcategorias(): void {
    this.subcategoriaService.getAll()
      .subscribe(
        res => {
          this.subcategorias = res;
        },
        err => console.error(err)
      );
  }

  refreshList(): void {
    this.retrieveSubcategorias();
    this.currentSubcategoria = null;
    this.currentIndex = -1;
  }

  setActiveSubcategoria(subcategoria, index): void {
    this.currentSubcategoria = subcategoria;
    this.currentIndex = index;
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

  setActiveCategoria(categoria, index): void {
    this.currentCategoria = categoria;
    this.currentIndex = index;
  }

}
