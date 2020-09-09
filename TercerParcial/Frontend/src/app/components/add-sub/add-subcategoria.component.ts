import { Component, OnInit } from '@angular/core';
import { SubcategoriaService } from 'src/app/services/subcategoria.service';
import { CategoriaService } from 'src/app/services/categoria.service';
import { Categoria } from 'src/app/models/categoria';

@Component({
  selector: 'app-add-subcategoria',
  templateUrl: './add-subcategoria.component.html',
  styleUrls: ['./add-subcategoria.component.css']
})
export class AddSubcategoriaComponent implements OnInit {
  categorias: any = [];
    subcategoria = {
    COD_CATEGORIA: '',
    COD_SUB_CATEGORIA: '',
    NOMBRE: '',
    DESCRIPCION: '',     
    FECHA_CREACION: ''
  };
  currentCategoria = null;
  currentIndex = -1;
  categoria = {
    COD_CATEGORIA: '',
    DESCRIPCION: ''
  };
  submitted: boolean;

  constructor(private subcategoriaService: SubcategoriaService, private categoriaService: CategoriaService) { }

  ngOnInit(): void {
    this.retrieveCategorias();
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

  saveSubcategoria(): void {
    const data = {
        COD_CATEGORIA: this.subcategoria.COD_CATEGORIA,
        COD_SUB_CATEGORIA: this.subcategoria.COD_SUB_CATEGORIA,
      NOMBRE: this.subcategoria.NOMBRE,
      DESCRIPCION: this.subcategoria.DESCRIPCION, 
      FECHA_CREACION: this.subcategoria.FECHA_CREACION
    };

    this.subcategoriaService.create(data)
      .subscribe(
        response => {
          console.log(response);
          this.submitted = true;
        },
        error => {
          console.log(error);
        });
  }

  newSubcategoria(): void {
    this.submitted = false;
    this.subcategoria = {
        COD_CATEGORIA: '',
      COD_SUB_CATEGORIA: '',
      NOMBRE: '',
      DESCRIPCION: '', 
      FECHA_CREACION: ''
    };
  }

  setActiveCategoria(categoria, index): void {
    this.currentCategoria = categoria;
    this.currentIndex = index;
  }

}
