<?php
/**
 * @copyright (c) 2021 Kraftors
 * @author Kraftors Team
 */

namespace Kraftors\Team\Setup\Patch\Schema;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;

/**
 * Patch is mechanism, that allows to do automatic upgrade data changes
 */
class ChangeColumn implements SchemaPatchInterface
{
    /**
     * @var ModuleDataSetupInterface $moduleDataSetup
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $this->moduleDataSetup->getConnection()->changeColumn(
            $this->moduleDataSetup->getTable('post'),
            'description',
            'shortdescription',
            [
                'type'     => Table::TYPE_TEXT,
                'length'   => 50,
                'nullable' => true,
                'comment'  => 'Short Description'
            ]
        );

        $this->moduleDataSetup->endSetup();
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }
}
