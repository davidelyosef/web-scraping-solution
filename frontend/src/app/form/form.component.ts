import { Component, Input } from '@angular/core';
import { UrlItem } from 'src/interfaces/UrlItem';

@Component({
  selector: 'app-form',
  templateUrl: './form.component.html',
  styleUrls: ['./form.component.scss'],
})
export class FormComponent {
  @Input() updateData: Function = () => {};

  url = '';
  depth: number | '' = '';
  urlTouched = false;
  depthTouched = false;

  onReset() {
    this.url = '';
    this.depth = '';
    this.urlTouched = false;
    this.depthTouched = false;
  }

  onSubmit(event: Event) {
    event.preventDefault();

    const newItem: UrlItem = {
      url: this.url,
      depth: this.depth,
    };

    this.updateData(newItem);
    this.onReset();
  }
}
