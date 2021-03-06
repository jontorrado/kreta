/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import Backbone from 'backbone';

class User extends Backbone.Model {
  defaults() {
    return {};
  }

  toString() {
    return `${this.get('first_name')} ${this.get('last_name')}`;
  }
}

export default User;
