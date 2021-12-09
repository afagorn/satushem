import { Component, OnInit } from '@angular/core';
import {DataService} from '../../data.service';
import {RestApiService} from '../../rest-api.service';
import { NgxSpinnerService } from 'ngx-spinner';

@Component({
  selector: 'app-orders',
  templateUrl: './orders.component.html',
  styleUrls: ['./orders.component.scss']
})
export class OrdersComponent implements OnInit {

  purchaseOrders = [];

  constructor(
    private data: DataService,
    private rest: RestApiService,
    private spinner: NgxSpinnerService
  ) { }

  async ngOnInit() {
    this.spinner.show();
    await this.fetchOrdersInfo();
    this.spinner.hide();
    this.data.setTitle('Мои заказы - Профиль');
  }

  async fetchOrdersInfo() {
    const respPurchases = await this.rest.getPurchaseOrders();
    this.purchaseOrders = respPurchases['data']['orders'];
  }

/*  async updateDeliveryStatus(order: any, status: boolean) {
    try {
      await this.rest.updateDeliveryPurchase(
        order['purchase']['_id'],
        this.data.user['id'],
        status
      );

      this
        .data
        .addToast('Информация обновлена', '', 'success');

      await this.ngOnInit();
    } catch (error) {
      this
        .data
        .error(error['message']);
    }
  } */
}
