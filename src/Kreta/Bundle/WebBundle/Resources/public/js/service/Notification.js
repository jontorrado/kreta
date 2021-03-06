/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class NotificationService {
  static showNotification(notification) {
    const model = App.collection.notification.add(notification);

    setTimeout(() => {
      App.collection.notification.remove(model);
    }, 5000);
  }
}

export default NotificationService;
