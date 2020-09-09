import { Component, OnInit } from '@angular/core';
import { SubcategoriaService } from 'src/app/services/subcategoria.service';

@Component({
  selector: 'app-add-subcategoria',
  templateUrl: './add-subcategoria.component.html',
  styleUrls: ['./add-subcategoria.component.css']
})
export class AddSubcategoriaComponent implements OnInit {
    subcategoria = {
    COD_CATEGORIA: '',
    COD_SUB_CATEGORIA: '',
    NOMBRE: '',
    DESCRIPCION: '',     
    FECHA_CREACION: ''
  };
  submitted: boolean;

  constructor(private subcategoriaService: SubcategoriaService) { }

  ngOnInit(): void {
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

}
