import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AspirantesListComponent } from './aspirantes-list.component';

describe('AspirantesListComponent', () => {
  let component: AspirantesListComponent;
  let fixture: ComponentFixture<AspirantesListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AspirantesListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AspirantesListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
