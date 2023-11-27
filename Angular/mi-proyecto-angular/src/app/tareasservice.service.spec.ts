import { TestBed } from '@angular/core/testing';

import { TareaService } from './tareasservice.service';

describe('TareasserviceService', () => {
  let service: TareaService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(TareaService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
