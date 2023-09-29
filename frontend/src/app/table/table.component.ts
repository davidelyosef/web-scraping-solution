import { Component, Input } from '@angular/core';
import { UrlItem } from 'src/interfaces/UrlItem';

@Component({
  selector: 'app-table',
  templateUrl: './table.component.html',
  styleUrls: ['./table.component.scss'],
})
export class TableComponent {
  @Input() data: UrlItem[] = [];
}
