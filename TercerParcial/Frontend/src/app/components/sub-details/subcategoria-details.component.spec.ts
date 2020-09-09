import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SubcategoriaDetailsComponent } from './subcategoria-details.component';

describe('SubcategoriaDetailsComponent', () => {
  let component: SubcategoriaDetailsComponent;
  let fixture: ComponentFixture<SubcategoriaDetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SubcategoriaDetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SubcategoriaDetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
