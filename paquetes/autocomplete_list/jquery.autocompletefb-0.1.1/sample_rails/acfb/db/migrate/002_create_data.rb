class CreateData < ActiveRecord::Migration
	def self.up
		User.new( :login => "coolarie",  :email => "arie@ruby.id"      ).save
		User.new( :login => "wharsojo",  :email => "wharsojo@gmail.com").save
		User.new( :login => "kironcong", :email => "bandung@ruby.id"   ).save
		User.new( :login => "karbitan",  :email => "karbitan@ruby.id"  ).save
	end

	def self.down
	end
end