import { Component } from '@angular/core';
import { UrlItem } from 'src/interfaces/UrlItem';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
})
export class AppComponent {
  title = 'Web Scraping - Netboost Media';

  data: UrlItem[] = [
    {
      url: 'https://david-yosef.web.app/',
      depth: 10,
    },
    {
      url: 'https://medium.com/@davidyf96/',
      depth: 2,
    },
    {
      url: 'https://github.com/davidelyosef',
      depth: 3,
    },
  ];

  updateData = (item: UrlItem) => {
    this.data = [
      ...this.data,
      item
    ];
  }
}
