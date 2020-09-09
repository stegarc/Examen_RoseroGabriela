import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SubcategoriasListComponent } from './subcategorias-list.component';

describe('SubcategoriasListComponent', () => {
  let component: SubcategoriasListComponent;
  let fixture: ComponentFixture<SubcategoriasListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SubcategoriasListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SubcategoriasListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
